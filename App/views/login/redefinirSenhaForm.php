<div class="form-box" id="login-box">
    <div class="header">Redefinir Senha</div>
    <form method="post">
        <div class="body bg-gray">
            <?php $this->getMsg(); ?>
            <div class="form-group">
                <h5>Crie uma nova senha</h5>
            </div>
            <div class="form-group">
                <input type="password" name="senha" class="form-control" placeholder="Nova senha"/>
            </div>
            <div class="form-group">
                <input type="password" name="rtsenha" class="form-control" placeholder="Repetir senha"/>
            </div>
        </div>
        <div class="footer">                                                               
            <button type="submit" name="recovery" value="1" class="btn bg-orange btn-block">Enviar</button>  

            <p><a href="login">Voltar</a></p>

        </div>
    </form>
</div>