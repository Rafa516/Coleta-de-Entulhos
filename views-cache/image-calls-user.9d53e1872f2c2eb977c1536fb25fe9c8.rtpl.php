<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #5FB404;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Imagens<b></a>
                </li>
            </ul>

             <div class="box box-widget">
                <div  id="myWorkContent">



                    <?php $counter1=-1;  if( isset($images) && ( is_array($images) || $images instanceof Traversable ) && sizeof($images) ) foreach( $images as $key1 => $value1 ){ $counter1++; ?>


                        <a class="image-link" href="<?php echo $value1["desphoto"]; ?>" > <img style="height: 15em;width: 15em" class="photo"id="image-preview" src="<?php echo $value1["desphoto"]; ?>"></a> 
                    
                    <?php } ?>


                </div>
            </div>

            <hr class="my-4" />

            <a href="/user/mycalls/<?php echo $user["iduser"]; ?>" class="btn btn-info btn-xs">voltar</a>


        </div>
    </div>
</div>



      