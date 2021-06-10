<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Fotos - Ponto de Entulhos,  <?php echo $markers["valueLocality"]; ?> 
                           <b></a>
                </li>
            </ul>

            <div class="box box-widget">
                <div id="myWorkContent">



                    <?php $counter1=-1;  if( isset($images) && ( is_array($images) || $images instanceof Traversable ) && sizeof($images) ) foreach( $images as $key1 => $value1 ){ $counter1++; ?>


                     <?php if( namePhotos($value1["idmarker"]) == '' ){ ?>


                       <a class="image-link" href="/res/ft_marker/noPhoto.png"> <img style="height: 15em;width: 15em" class="photo"
                            id="image-preview" src="/res/ft_marker/noPhoto.png" ></a>

                     <?php }else{ ?>

                    <a class="image-link" href="<?php echo $value1["desphoto"]; ?>"> <img style="height: 15em;width: 15em" class="photo"
                            id="image-preview" src="<?php echo $value1["desphoto"]; ?>"></a>
                    <?php } ?>

                    <?php } ?>


                </div>
            </div>

            <hr class="my-4" />

            <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>


        </div>
    </div>
</div>