<?php
namespace App\controllers;
use Framework\core\Controller;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use FilesystemIterator;
class GaleriaController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->view->setActive('galeria');
        $this->view->setTheme('admin');
    }
    function index() {
        $this->restricted();
        $ga = $this->loadModel('galeria');
        $galerias = $ga->getAlbuns();
        $this->view->setJS(array('shared/datatables.min','shared/dataTables.bootstrap.min','index'));
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->setRegistros(sizeof($galerias),'total');
        $this->view->setRegistros($galerias,'galerias');
        $this->view->render('index');
    }
    function criar(){
        $this->restricted();
        if(!empty($this->getPostParam('nome'))){
            $ga = $this->loadModel('galeria');
            $ga->setNo_album($this->getPostParam('nome'));
            $ga->setId_pessoa($this->getUser('id_pessoa'));
            $ga->setAlbum();
            if($ga->getId_album()){
                $this->geraPastas($ga->getId_album());
                $this->Redirect('galeria/editar/'.$ga->getId_album());
            }
        } else {
            $this->Redirect('galeria');
        }
        
    }
    function editar($id){
        $this->restricted();
        
        $ga = $this->loadModel('galeria');
        $ga->setId_album($id);
        $album = $ga->getAlbum();
        
        $fotos = $ga->getFotosAlbum();
        
        $this->view->setRegistros($album,'album');
        $this->view->setRegistros($fotos,'fotos');
        $this->view->setJS(array('shared/canvas-to-blob.min','shared/resize','galeria'));
        $this->view->render('editar');
    }
    function add($id_album) {
        $this->restricted();
        if ($id_album) {
            // Recuperando imagem em base64
            // Exemplo: data:image/png;base64,AAAFBfj42Pj4
            $imagem = $this->getPostParam('imagem');
            // Separando tipo dos dados da imagem
            // $tipo: data:image/png
            // $dados: base64,AAAFBfj42Pj4
            list($tipo, $dados) = explode(';', $imagem);
            // Isolando apenas o tipo da imagem
            // $tipo: image/png
            list(, $tipo) = explode(':', $tipo);
            // Isolando apenas os dados da imagem
            // $dados: AAAFBfj42Pj4
            list(, $dados) = explode(',', $dados);
            // Convertendo base64 para imagem
            $dados = base64_decode($dados);
            $foto = $this->loadModel('foto');
            $foto->setDc_extensao('jpg');
            $foto->setId_album($id_album);
            
            $foto->setFotoAlbum();

            $nome = $foto->getId_foto();
            if ($nome) {
                // Salvando imagem em disco
                file_put_contents("img/albuns/$id_album/{$nome}.jpg", $dados);
                $this->geraThumb($id_album, "{$nome}.jpg");
                echo json_encode(array('success' => true, 'message' => 'Imagem salva com sucesso', 'id' => $nome));
                exit;
            } else {
                echo json_encode(array('success' => false, 'message' => 'Erro ao salvar imagem'));
                exit;
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Erro ao salvar imagem'));
            exit;
        }
    }
    function titulo($id){
        $this->restricted();
        $ga = $this->loadModel('galeria');
        $ga->setId_album($id);
        $ga->setNo_album($this->getPostParam('title'));
        $ga->updTitulo();
    }
    private function geraPastas($id){
        $this->validaPermissaoUsuario(2, 2,true);
        if($id){
            mkdir("img/albuns/$id", 0777,true);
            mkdir("img/albuns/$id/thumb", 0777,true);
        }
    }
    private function geraThumb($id_album,$nome_foto, $lar_maxima = 450, $alt_maxima = 333, $qualidade = 50) { 
        $source_path = "img/albuns/$id_album/$nome_foto";
        $dirTumb = "img/albuns/$id_album/thumb/";

        list($source_width, $source_height, $source_type) = getimagesize($source_path);

        switch ($source_type) {
            case IMAGETYPE_GIF:
                $source_gdim = imagecreatefromgif($source_path);
                break;
            case IMAGETYPE_JPEG:
                $source_gdim = imagecreatefromjpeg($source_path);
                break;
            case IMAGETYPE_PNG:
                $source_gdim = imagecreatefrompng($source_path);
                break;
        }

        $source_aspect_ratio = $source_width / $source_height;
        $desired_aspect_ratio = $lar_maxima / $alt_maxima;

        if ($source_aspect_ratio > $desired_aspect_ratio) {
            $temp_height = $alt_maxima;
            $temp_width = ( int ) ($alt_maxima * $source_aspect_ratio);
        } else {
            $temp_width = $lar_maxima;
            $temp_height = ( int ) ($lar_maxima / $source_aspect_ratio);
        }


        $temp_gdim = imagecreatetruecolor($temp_width, $temp_height);
        imagecopyresampled(
            $temp_gdim,
            $source_gdim,
            0, 0,
            0, 0,
            $temp_width, $temp_height,
            $source_width, $source_height
        );

        $x0 = ($temp_width - $lar_maxima) / 2;
        $y0 = ($temp_height - $alt_maxima) / 2;
        $desired_gdim = imagecreatetruecolor($lar_maxima, $alt_maxima);
        imagecopy(
            $desired_gdim,
            $temp_gdim,
            0, 0,
            $x0, $y0,
            $lar_maxima, $alt_maxima
        );

        imagejpeg($desired_gdim,$dirTumb.$nome_foto, $qualidade);
        imagedestroy($desired_gdim);
    
    }
    function delimage($img,$album){
        $this->restricted();
        if($img){
            $dados = explode('.',$img);
            $foto = $this->loadModel('foto');
            $foto->setId_foto($dados[0]);
            if($foto->delFoto()){
                if(file_exists("img/albuns/$album/$img")){
                    unlink("img/albuns/$album/$img");
                    unlink("img/albuns/$album/thumb/$img");
                }
                echo json_encode(array('success'=>true));    
            } else {
                echo json_encode(array('success'=>false,'message'=>'Erro ao excluir imagem'));    
            }
            
        } else {
            echo json_encode(array('success'=>false,'message'=>'Erro ao excluir imagem'));
        }
    }
    function capa($img){
        $this->restricted();
        if($img){
            $dados = explode('.',$img);
            $foto = $this->loadModel('foto');
            $foto->setId_foto($dados[0]);
            if($foto->setCapaGaleria()){
                echo json_encode(array('success'=>true));    
            } else {
                echo json_encode(array('success'=>false,'message'=>'Erro ao definir imagem como capa'));    
            }
            
        } else {
            echo json_encode(array('success'=>false,'message'=>'Erro ao definir imagem como capa'));
        }
    }
    function del($id){
        $this->restricted();
        $ga = $this->loadModel('galeria');
        $ga->setId_album($id);
        if($ga->del()){
            $dirPath = "img/albuns/$id";
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirPath, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) {
                $path->isFile() ? unlink($path->getPathname()) : rmdir($path->getPathname());
            }
            rmdir($dirPath);
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('success'=>false,'message'=>'Erro ao excluir galeria'));
        }
    }
    function exibir($id){
        $this->view->setTheme('default');
        $ga = $this->loadModel('galeria');
        $ga->setId_album($id);
        $fotos = $ga->getFotosGaleria();    
        $this->view->setRegistros($fotos,'fotos');
        $this->view->setJS(array('shared/jquery.fancybox','exibir'));
        $this->view->setCSS(array('shared/jquery.fancybox'));
        $this->view->render('exibir');
    }

}

