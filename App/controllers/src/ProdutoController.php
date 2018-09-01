<?php

namespace App\controllers;

use Framework\core\Controller;

class ProdutoController extends Controller {

    function __construct() {
        parent::__construct();
        $this->restricted();
        $this->view->setActive('product');
        $this->view->setTheme('admin');
    }

    function index() {

        if ($this->getGetInt('draw')) {
            $prod = $this->loadModel('produto');
            $prod->setId_pessoa($this->pessoa());
            $prod->setNm_limite($this->getGetString('length'));
            $prod->setNm_offset($this->getGetString('start'));
            $search = $this->getGetMultiParam('search');
            $order = $this->getGetMultiParam('order');
            //colunas que possam serem ordenadas
            $columns = array('id_produto', 'dc_produto', 'no_marca', 'no_categoria', 'id_promocao', 'nm_estoque', 'nm_valor');
            $textOrder = '';
            foreach ($order as $o) {
                $textOrder .= $columns[$o['column']] . ' ' . $o['dir'] . ',';
            }
            $textOrder = rtrim($textOrder, ',');
            $prod->setDc_order($textOrder);
            $prod->setDc_produto(!empty($search['value']) ? $search['value'] : NULL);
            $produtos = $prod->getProdutos();
            $result = array();
            $result['recordsTotal'] = $prod->getTotalProdutos();
            $result['recordsFiltered'] = $prod->getTotalProdutos();
            foreach ($produtos as $p) {
                $result['data'][] = array($p['id_produto'], $p['dc_produto'] . $p['qtd_fotos'],
                    $p['no_marca'], $p['no_categoria'],
                    $p['dt_exp_promocao'], $p['nm_estoque'],
                    'R$ ' . str_replace('.', ',', $p['nm_valor_venda']),
                    $p['qtd_fotos'], $p['id_produto']);
            }
            echo json_encode($result);
            exit;
        }

        $this->view->setJS(array('shared/datatables.min', 'shared/dataTables.bootstrap.min',
            'shared/jquery.cropit', 'index', 'images'));
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->render('index');
    }

    function get() {
        $data = file_get_contents("php://input");
        $busca = json_decode($data);
        $prod = $this->loadModel('produto');
        $prod->setDc_produto($busca->q);
        $produtos = $prod->getProdutosSearch();
        echo json_encode($produtos);
    }

    function search() {
        $prod = $this->loadModel('produto');
        $prod->setDc_produto($this->getGetString('q'));
        $produtos = $prod->getProdutosSearch();
        $this->view->setRegistros(sizeof($produtos), 'total');
        $this->view->setRegistros($produtos, 'produtos');
        $this->view->setJS(array('shared/datatables.min', 'shared/dataTables.bootstrap.min', 'index'));
        $this->view->setCSS(array('shared/dataTables.bootstrap.min'));
        $this->view->render('index');
    }

    function detalhes($id) {
        $prod = $this->loadModel('produto');
        $prod->setId_produto($id);
        $produto = $prod->getProdutoSite();
        $this->view->setRegistros($produto, 'produto');
        $this->view->renderAjax('detalhes');
    }

    function form($id = 0) {

        $cat = $this->loadModel('categoria');
        $cat->setId_pessoa($this->pessoa());
        $categorias = $cat->getCategorias();

        $mar = $this->loadModel('marca');
        $mar->setId_pessoa($this->pessoa());
        $marcas = $mar->getMarcas();

        $emb = $this->loadModel('embalagem');
        $emb->setId_pessoa($this->pessoa());
        $embalagens = $emb->getEmbalagens();

        if ($id) {
            $prod = $this->loadModel('produto');
            $prod->setId_pessoa($this->pessoa());
            $prod->setId_produto($id);
            $produto = $prod->getProduto();
            if (empty($produto)) {
                $this->Redirect('produto');
                exit;
            }
            $foto = $this->loadModel('foto');
            $foto->setId_produto($id);
            $fotos = $foto->getFotosProduto();

            $this->view->setRegistros($fotos, 'fotos');
            $this->view->setRegistros($produto, 'produto');
        }
        $this->view->setRegistros($categorias, 'categorias');
        $this->view->setRegistros($marcas, 'marcas');
        $this->view->setRegistros($embalagens, 'embalagens');
        $this->view->setCSS(array('shared/summernote', 'shared/bootstrap-datetimepicker.min'));
        $this->view->setJS(array('shared/maskMoney', 'shared/summernote.min', 'shared/summernote-pt-BR',
            'shared/jquery.cropit', 'shared/Moment', 'shared/Moment.pt-br',
            'shared/bootstrap-datetimepicker.min', 'produto', 'images'));
        $this->view->render('form');
    }

    function add() {
        $validar = '{"required":["nome","marca","categoria","valor","embalagem","qt_emb"';
        if ($this->getPostInt('promocao')) {
            $validar .= ',"expira"';
        }
        $validar .= ']}';
        $result = $this->validatePost($validar);
        if ($result['success']) {
            $prod = $this->loadModel('produto');
            $prod->setId_pessoa($this->pessoa());
            $prod->setId_produto($this->getPostInt('id'));
            $prod->setDc_produto($this->getPostString('nome'));
            $prod->setDc_descricao($this->getPostParam('descricao'));
            $prod->setId_categoria($this->getPostInt('categoria'));
            $prod->setId_marca($this->getPostInt('marca'));
            //$prod->setCd_barra($this->getPostString('cod'));
            $prod->setNm_estoque($this->getPostInt('estoque'));
            $prod->setNm_estoque_min($this->getPostInt('estoque_min'));
            if ($this->getPostInt('promocao')) {
                $prod->setId_promocao($this->getPostInt('promocao'));
                $prod->setNm_porcentagem($this->getPostFloat('nm_porcentagem'));
                $prod->setDt_exp_promocao($this->getPostParam('expira'));
            } else {
                $prod->setId_promocao(0);
                $prod->setNm_porcentagem(0);
                $prod->setDt_exp_promocao(NULL);
            }
            if ($this->getPostInt('embalagem')) {
                $prod->setId_embalagem($this->getPostInt('embalagem'));
            }
            $prod->setQt_embalagem($this->getPostInt('qt_emb') ? $this->getPostInt('qt_emb') : 1);
            $valor = $this->getPostParam('valor');
            $prod->setNm_valor(str_replace(',', '.', $valor));
            $id = $prod->set();
            if ($id) {
                echo json_encode(array('success' => true, 'message' => 'Produto cadastrado com sucesso!', 'id' => $id));
            }
        } else {
            echo json_encode($result);
        }
    }

    function import() {
        $this->view->setJS(array('import'));
        $this->view->render('import');
    }

    function setline() {
        $line = $this->getPostParam('line');
        $dados = explode(';', $line);
        $line .= ';' . $this->getUser('no_nome_completo') . ';' . date('d/m/Y H:i:s');
        if (sizeof($dados) && sizeof($dados) == 9) {
            $codProd = (string) $dados[0];
            $nomeProd = addslashes($dados[1]); // nome do produto
            $precoProd = !empty($dados[3]) ? (float) str_replace(',', '.', $dados[3]) : 0; // preco
            $qtdEmEst = !empty($dados[4]) ? (int) $dados[4] : 0; // qtd em estoque
            $marcaProd = !empty($dados[5]) ? $dados[5] : ''; // marca
            $embProd = !empty($dados[7]) ? $dados[7] : ''; // embalagem
            $qtEmbProd = !empty($dados[8]) ? (int) $dados[8] : 0; // qtd embalagem

            $emb = $this->loadModel('embalagem');
            $emb->setId_pessoa($this->pessoa());
            $emb->setNo_embalagem($embProd);
            $idEmbalagem = $emb->getIdEmbalagemByNome();

            $mar = $this->loadModel('marca');
            $mar->setId_pessoa($this->pessoa());
            $mar->setNo_marca($marcaProd);
            $idMarca = $mar->getIdMarcaByNome();

            if (!empty($codProd) && !empty($nomeProd)) {
                $prod = $this->loadModel('produto');
                $prod->setId_pessoa($this->pessoa());
                $prod->setId_marca($idMarca);
                $prod->setNm_porcentagem(0);
                $prod->setDc_produto($nomeProd);
                $prod->setNm_valor($precoProd);
                $prod->setNm_estoque($qtdEmEst);
                $prod->setId_embalagem($idEmbalagem);
                $prod->setQt_embalagem($qtEmbProd);
                $prod->setCd_produto_cliente($codProd);
                $prod->getProdutoByCod(); //verifica se o produto já existe e seta o id para somente atualizar
                if ($prod->set()) {
                    $line .= ';SUCCESS' . PHP_EOL;
                    echo json_encode(array('success' => true, 'msg' => 'Importado com sucesso!'));
                } else {
                    echo json_encode(array('success' => false, 'msg' => 'Erro ao atualizar dados!'));
                }
            }
        } else {
            $line .= ';ERROR' . PHP_EOL;
            echo json_encode(array('success' => false, 'msg' => 'Qtd ou formato incorreto de dados!'));
        }
        $file = DIR_XML . date('d-m-Y') . ".txt";
        if (!file_exists($file)) {
            $fp = fopen($file, 'w');
        } else {
            $fp = fopen($file, 'a');
        }
        fwrite($fp, $line);
        fclose($fp);
    }

    function proccess() {

        $myfile = fopen($_FILES['arquivo']['tmp_name'], "r") or die("Unable to open file!");
        $sql = "";
        while (!feof($myfile)) {
            $linha = utf8_encode(fgets($myfile));
            $dados = explode(';', $linha);
            if (sizeof($dados)) {
                $preco = !empty($dados[2]) ? (float) str_replace(',', '.', $dados[2]) : 0;
                $estoque = !empty($dados[3]) ? (int) $dados[3] : 0;
                $qtEmb = !empty($dados[7]) ? (int) $dados[7] : 0;
                $dados[4] = !empty($dados[4]) ? $dados[4] : '';
                $dados[6] = !empty($dados[6]) ? $dados[6] : '';
                $dados[0] = addslashes($dados[0]);
                //$sql .= "('{$dados[0]}',$preco,$estoque,'{$dados[4]}','{$dados[6]}',$qtEmb),";
                $sql .= "('{$dados[0]}',$preco,$estoque,$qtEmb,0,0),";
            }
        }
        $sql = rtrim($sql, ',');
        $sql .= ';';

        fclose($myfile);
        $prod = $this->loadModel('produto');
        $prod->import($sql);
    }

    function del($id) {
        if ($id) {
            $prod = $this->loadModel('produto');
            $prod->setId_produto($id);
            if ($prod->delete()) {
                echo json_encode(array("success" => true, "message" => "Cliente excluído com sucesso!"));
            }
        }
    }

    function validbarcode($barcode = false) {
        if ($barcode) {
            $prod = $this->loadModel('produto');
            $prod->setCd_barra($barcode);
            $produto = $prod->getProdutoCodBarra();
            if (empty($produto)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'id' => $produto['id_produto'], 'message' => 'Este produto já está cadastrado!'));
            }
        } else {
            echo json_encode(array('success' => true));
        }
    }

    function setimage($id_produto) {
        if ($id_produto) {
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
            $foto->setId_produto($id_produto);
            $foto->setId_pessoa($this->getUser('id_pessoa'));
            $foto->setFotoProduto();

            $nome = $foto->getId_foto();
            if ($nome) {
                // Salvando imagem em disco
                file_put_contents("img/produtos/{$nome}.jpg", $dados);
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

    function delimage($img) {
        if ($img) {
            $dados = explode('.', $img);
            $foto = $this->loadModel('foto');
            $foto->setId_foto($dados[0]);
            if ($foto->delFoto()) {
                if (file_exists("img/produtos/$img")) {
                    unlink("img/produtos/$img");
                }
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Erro ao excluir imagem'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Erro ao excluir imagem'));
        }
    }

    function capa($img) {
        if ($img) {
            $dados = explode('.', $img);
            $foto = $this->loadModel('foto');
            $foto->setId_foto($dados[0]);
            if ($foto->setCapa()) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Erro ao definir imagem como capa'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Erro ao definir imagem como capa'));
        }
    }

    function categoria($produto, $categoria) {
        $prod = $this->loadModel('produto');
        $prod->setId_produto($produto);
        $prod->setId_categoria($categoria);
        if ($prod->setIdCategoriaProduto()) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false));
        }
    }

}
