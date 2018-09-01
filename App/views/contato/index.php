<div id="main">
    <section id="contato">
        <div class="container">
            
            <h2 class="heading">
                <span class="text-uppercase">CONTATO</span>
            </h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form id="form-contato" method="post" action="contato/send">
                                <h3>ENVIE SUA MENSAGEM</h3>
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Informe seu nome" />
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Informe seu e-mail" />
                                </div>
                                <div class="form-group">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" 
                                           class="form-control" placeholder="Informe seu telefone" data-mask="(99) 9999-9999?9" />
                                </div>
                                <div class="form-group">
                                    <label for="mensagem">Mensagem</label>
                                    <textarea name="mensagem" id="mensagem" class="form-control" 
                                              rows="4" placeholder="Diga-nos como podemos ajudá-lo"></textarea>
                                </div>
                                <div class="form-group ajax-response">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-action-ajax">
                                        <i class="fa fa-spin fa-spinner"></i>
                                        Enviar Mensagem
                                    </button>
                                </div>
                            </form>  
                        </div><!--/.panel-body-->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form id="form-curriculum" enctype="multipart/form-data" method="post">
                                <h3>TRABALHE CONOSCO</h3>
                                <p>Quer fazer parte de nossa equipe? Envie seu curriculum através do formulário abaixo.</p>
                                <div class="form-group">
                                    <label for="apresentacao">Mensagem de Apresentação</label>
                                    <textarea name="apresentacao" id="apresentacao" 
                                        class="form-control" rows="10" placeholder="Olá! Meu nome é Fulano de Tal. Trabalho há x anos..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="arquivo">Arquivo <small class="text-danger">(Somente doc, docx ou pdf - Tamanho Max 2MB)</small></label>
                                    <input type="file" name="arquivo" id="arquivo" class="form-control" />
                                </div>
                                <div class="form-group ajax-response">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-action-ajax">
                                        <i class="fa fa-spin fa-spinner"></i>
                                        Enviar Curriculum
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> <!--/.container-->
        <div class="container">
            <div id="map-canvas">

            </div>
        </div>
        
    </section>
</div>