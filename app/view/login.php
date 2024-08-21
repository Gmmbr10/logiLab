<section class="h-100 container d-flex justify-content-center align-items-center flex-column gap-3">

    <h1 class="display-2 fw-bold text-warning">Entrar</h1>

    <form action="#" method="POST" class="border border-3 border-warning p-5 rounded-2 d-flex flex-column gap-4">

        <?php

        if (isset($this->resultadoModel) && $this->resultadoModel["resultado"] == "erro") {

            foreach ($this->resultadoModel["erros"] as $erro) {
                echo "<p class=\"bg-danger p-2 rounded rounded-3\">{$erro}</p>";
            }
        }

        if (isset($this->resultadoModel) && $this->resultadoModel["resultado"] == "sucesso") {

            foreach ($this->resultadoModel["mensagem"] as $mensagem) {
                echo "<p class=\"bg-success p-2 rounded rounded-3\">{$mensagem}</p>";
            }
        }

        ?>

        <section>
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" placeholder="Email@gmail.com" value="<?=$this->formDados["email"]?>" class="form-control">
        </section>

        <section>
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" placeholder="Senha" value="<?=$this->formDados["senha"]?>" class="form-control">
        </section>

        <button type="submit" name="btnLogin" class="btn btn-warning">Entrar</button>

        <p class="text-center text-warning text-decoration-none">Não tem uma conta? Crie uma <a href="cadastrar" class="text-warning">clicando aqui</a></p>

    </form>

</section>