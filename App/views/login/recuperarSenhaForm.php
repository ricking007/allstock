<div class="form-box" id="login-box">
    <div class="header">Login</div>
    <form action="login/forgot" method="post">
        <div class="body bg-gray">
            <?php $this->getMsg(); ?>
            <div class="form-group">
                <h5>Informe seu e-mail cadastrado</h5>
            </div>
            <div class="form-group">
                <input type="text" name="login" class="form-control" placeholder="usuario@email.com"/>
            </div>
        </div>
        <div class="footer">                                                               
            <button type="submit" class="btn bg-orange btn-block">Enviar</button>  

            <p><a href="login">Voltar</a></p>

        </div>
    </form>
</div>