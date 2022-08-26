<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Descrição do Projeto

<p>
        # Projeto baseado em um sistema de universitário onde se administra todos os cursos, grade-curriculares, usuários entre outros.
</p>

## Projeto ainda em desenvolvimento!

<p><a href="#config"># Configuração Inicial do Projeto</a></p>
<p><a href="#desenvolvido"># Desenvolvido até o momento</a></p>

<hr>
<p id="config">

## Configurando o Projeto ...
 
        composer install --no-scripts
     
#Copie o arquivo .env.example

        cp .env.example .env

#Crie uma key para o projeto

        php artisan key:generate

#Configurar o arquivo .env com base no seu Banco de Dados e SMTP para recuperação de senhas 

#Execute as migrations

        php artisan migrate --seed

</p> 
<hr>
<p id="desenvolvido">

## Até o momento:

* CRUD Usuários em Andamento 

* Validação dos inputs em modal (CREATE/EDIT)
* Paginação de Registros (5)
* Ordenação Alfabética, Departamento e por Cadastro
* Gerando senha default ao criar um usuário


* Criando Seeder para 5 Estados diferentes do Brasil
* Cadastrando Campus com base nos Estados


* CRUD para Cursos 
* Criando Seeder com a classificação de cursos: Exatas, Humanas e Biológicas
* Cadastrando disciplinas com base na área de conhecimento
* Criando grade curricular com disciplinas para cada semestre


* Cadastrando período de ínicio/término das aulas
* Cadastrando período de avaliações de cada disciplina/semestre


## Falta ajustar:

* Foto dos usuários;

</p>
     
<hr>


