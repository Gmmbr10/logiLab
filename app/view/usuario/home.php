<section class="pt-2">

    <h1 class="text-center">Bem-vindo, <?= $_SESSION["usuario"]["nome"] ?>!</h1>

</section>

<section class="py-5">
    <form action="#" name="reservar" method="POST" class="border border-3 border-warning p-5 rounded-2 d-flex flex-column gap-5">

        <?php
        
        if ( isset($this->resultadoModel) && $this->resultadoModel["resultado"] == "erro" ) {

            foreach ($this->resultadoModel["erros"] as $erro) {
                
                echo "<p class=\"bg-danger p-2 rounded rounded-3\">{$erro}</p>";

            }

        }

        if ( isset($this->resultadoModel) && $this->resultadoModel["resultado"] == "alerta" ) {

            foreach ($this->resultadoModel["mensagem"] as $mensagem) {
                
                echo "<p class=\"bg-warning p-2 rounded rounded-3\">{$mensagem}</p>";

            }

        }

        if ( isset($this->resultadoModel) && $this->resultadoModel["resultado"] == "sucesso" ) {

            foreach ($this->resultadoModel["mensagem"] as $mensagem) {
                
                echo "<p class=\"bg-success p-2 rounded rounded-3\">{$mensagem}</p>";

            }

        }

        ?>

        <section>

            <p class="fw-bold h3">
                Matéria de base:
            </p>

            <section class="row pt-3 gap-4">

                <section class="col-sm">
                    <input type="radio" name="materia" value="comum" id="comum" class="btn-check">
                    <label for="comum" class="btn btn-outline-warning w-100 py-3 fw-bold">
                        Comum
                    </label>
                </section>

                <section class="col-sm">
                    <input type="radio" name="materia" value="adm" id="adm" class="btn-check">
                    <label for="adm" class="btn btn-outline-warning w-100 py-3 fw-bold">
                        Técnica - Administração
                    </label>
                </section>

                <section class="col-sm">
                    <input type="radio" name="materia" value="info" id="info" class="btn-check">
                    <label for="info" class="btn btn-outline-warning w-100 py-3 fw-bold">
                        Técnica - Informática
                    </label>
                </section>
            </section>
        </section>

        <section class="d-flex flex-column gap-2">
            <label for="dataUso" class="fw-bold h3">Data de uso:</label>
            <input type="date" name="dataUso" class="form-control">
        </section>

        <section>

            <p class="fw-bold h3">Aula(s) de uso:</p>

            <section class="row pt-3 gap-3">

                <section class="col-sm d-flex flex-column gap-3">
                    <section class="w-100 d-flex align-items-center gap-3">
                        <input type="checkbox" name="aulas[]" id="1" value="1">
                        <label for="1">1&deg; Aula ( 07:30 - 08:20 )</label>
                    </section>
                    <section class="w-100 d-flex align-items-center gap-3">
                        <input type="checkbox" name="aulas[]" id="2" value="2">
                        <label for="2">2&deg; Aula ( 08:20 - 09:10 )</label>
                    </section>
                    <section class="w-100 d-flex align-items-center gap-3">
                        <input type="checkbox" name="aulas[]" id="3" value="3">
                        <label for="3">3&deg; Aula ( 09:10 - 10:00 )</label>
                    </section>
                    <section class="w-100 d-flex align-items-center gap-3">
                        <input type="checkbox" name="aulas[]" id="4" value="4">
                        <label for="4">4&deg; Aula ( 10:20 - 11:10 )</label>
                    </section>
                </section>
                <section class="col-sm d-flex flex-column gap-3">
                    <section class="w-100 d-flex align-items-center gap-3">
                        <input type="checkbox" name="aulas[]" id="5" value="5">
                        <label for="5">5&deg; Aula ( 11:10 - 12:00 )</label>
                    </section>
                    <section class="w-100 d-flex align-items-center gap-3">
                        <input type="checkbox" name="aulas[]" id="6" value="6">
                        <label for="6">6&deg; Aula ( 13:00 - 13:50 )</label>
                    </section>
                    <section class="w-100 d-flex align-items-center gap-3">
                        <input type="checkbox" name="aulas[]" id="7" value="7">
                        <label for="7">7&deg; Aula ( 13:50 - 14:40 )</label>
                    </section>
                    <section class="w-100 d-flex align-items-center gap-3">
                        <input type="checkbox" name="aulas[]" id="8" value="8">
                        <label for="8">8&deg; Aula ( 14:40 - 15:30 )</label>
                    </section>
                </section>

            </section>

        </section>

        <section>

            <p class="fw-bold h3">A aula será dividida em turmas (A e B)?</p>

            <section class="d-flex gap-3 pt-3">
                <input type="radio" name="turmaDividida" value="sim" id="sim" class="btn-check">
                <label for="sim" class="btn btn-outline-warning py-3 fw-bold">
                    Sim
                </label>
                <input type="radio" name="turmaDividida" value="nao" id="nao" class="btn-check">
                <label for="nao" class="btn btn-outline-warning py-3 fw-bold">
                    Não
                </label>
            </section>

        </section>

        <button type="submit" name="btnAgendar" class="btn btn-warning p-3 fw-bold">Agendar</button>

    </form>
</section>