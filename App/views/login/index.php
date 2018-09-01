<div class="form-box" id="login-box">
    <div class="header">Login</div>
    <form action="login/loginDo" method="post">
        <div class="body bg-gray">
            <?php $this->getMsg(); ?>
            <div class="form-group">
                <input type="text" name="login" class="form-control" placeholder="usuario@email.com"/>
            </div>
            <div class="form-group">
                <input type="password" name="senha" class="form-control" placeholder="Sua senha"/>
            </div>          
            <div class="form-group">
                
            </div>
        </div>
        <div class="footer">                                                               
            <button type="submit" class="btn bg-orange btn-block">Entrar</button>  

            <p><a href="login/forgot">Esqueci minha senha</a></p>

        </div>
    </form>
</div>
