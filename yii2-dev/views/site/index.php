<?php

/** @var yii\web\View $this */

use app\models\Subject;
use app\models\SubjectSearch;

use co0lc0der\Lte3Widgets\CardWidget;
use co0lc0der\Lte3Widgets\CardToolsHelper;
use yii\helpers\Html;
use webvimark\modules\UserManagement\models\User;



$this->title = 'My Yii Application';


?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Bienvenido!</h1>
        
        <p class="lead">Esta es la plataforma de cursos</p>

        <!-- <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p> -->
    </div>

    <div class="body-content">

        <div class="flex-container" style="display: flex;flex-direction: row; align-items: center; flex-wrap: wrap; justify-content: center; margin-bottom: 180px;">

            <?php

            $courses_2 = SubjectSearch::find()->all();

            if(!empty($courses_2)){
                foreach ($courses_2 as $key => $value) {

                    echo Html::beginTag('div', ['style' => 'margin: 10px; max-width: 380px;']);

                    CardWidget::begin([
                        'title' => $value->name,
                        'footer' => $value->price . ' $</br>' . Html::a('Ir al curso', ['/subject/view', 'id'=>$value->id], ['class'=>'btn btn-primary']) ,
                    ]);

                    echo $value->description;

                    CardWidget::end();

                    echo Html::endTag('div');
                }
            }
            
            ?>


        </div>

        <div class="row">

            <h3>Sobre Nosotros</h3>

            <div class="col-lg-4">
                <h2>Nuestros Cursos</h2>

                <p>Nuestros cursos son ideales para cualquier nivel de habilidad. 
                    Desde principiantes a personas mas avanzadas, todos pueden aprender 
                    algo nuevo a travez de alguno de nuestros cursos.</p>

                <p><?=Html::a('Cursos', ['/subject/index', 'id'=>$value->id], ['class'=>'btn btn-outline-secondary'])?></p>
            </div>
            <div class="col-lg-4">
                <h2>Nuestros Profesores</h2>

                <p>Nos enorgullece decir que nuestros profesores son algunos 
                    de los profesionales mas respetados de sus respectivas areas. 
                Nuestro proceso de seleccion es el tipico para la industria, 
                pero nos gusta mantener un estandar alto a la hora de elegir a quienes contratar.</p>

            </div>
            <div class="col-lg-4">
                <h2>Nuestros Alumnos</h2>

                <p>Nuestros alumnos pueden disfrutar de los mejores cursos al mejor precio. 
                    Nos gusta decir que cada dia, con la ayuda de cada uno de ellos, 
                    nos acercamos cada vez mas a ser una institucion prestigiosa pero a la vez accesible 
                    y sin ningun tipo de prejuicio. Todo el mundo puede tomar alguno de nuestros cursos.
                </p>

                <p>Proximamente estaremos habilitando un programa de becas, para que todos aquellos que no pueden acceder a nuestros puedan hacerlo</p>

            </div>
        </div> 

    </div>
</div>