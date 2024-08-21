<h1 align="center">Reserva Lab</h1>

<p align="center">App de EAMT ( Estudos Avançados de Matemática e suas Tecnologias )</p>

<p align="center">
	<a href="#tecnologias">Tecnologias</a>&nbsp;&nbsp;&#124;&nbsp;&nbsp;
	<a href="#sobre-o-app">Sobre o app</a>&nbsp;&nbsp;&#124;&nbsp;&nbsp;
	<a href="#executar-o-app">Executar o app</a>&nbsp;&nbsp;&#124;&nbsp;&nbsp;
	<a href="#autores">Autores</a>&nbsp;&nbsp;
</p>

## Tecnologias

Esse app foi desenvolvido com as seguintes tecnologias:

- HTML e CSS
- JavaScript
- PHP

## Sobre o app

Este app tem a ideia de agendar o uso dos laboratórios Além disso, temos a ideia de criar uma rotatividade durante o uso dos laboratórios.

## Executar o app

Com servidor Xampp:

<ol>
	<li>Instalar o xampp</li>
	<li>Copiar os arquivos para a pasta do servidor</li>
	<li>Inicie o servidor</li>
	<li>Acesse <a href="http://localhost" target="_blank">localhost</a></li>
</ol>

Com container Docker:

<ol>
	<li>Instalar o Docker em sua máquina</li>
	<li>Baixar a imagem do repositório <a href="https://github.com/Gmmbr10/docker-apache-image" target="_blank">para apache com php</a></li>
	<li>Coloque a imagem na pasta do app</li>
	<li>Execute `docker image build -t reservaLab .`</li>
	<li>Execute `docker container run -d -p 8000:80 reservaLab`</li>
	<li>Acesse <a href="http://localhost:8000" target="_blank">localhost:8000</a></li>
</ol>

## Autores

<ul>
	<li>Giovanne Monteiro de Melo</li>
	<li>Ysabela da Silva Souza</li>
</ul>

