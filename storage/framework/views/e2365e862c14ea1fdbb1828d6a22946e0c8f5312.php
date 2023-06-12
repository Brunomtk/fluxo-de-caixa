

<?php $__env->startSection('content'); ?>
<body class="animated-background" >
    
<div class="alin-esquesrda ">
<div class="card container_home" style="width: 28rem; height: 23rem">
    <img class="container" style="width: 6rem; height: 6rem; margin-top:8px;" src="image/user.png"/>
  <div class="card-body">
    <!-- forms de login -->
    <form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>
    <div class="form-group input-group">
        <input type="text" id="name" required class= "input" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="exampleFormControlInput1 email"  value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
        <label for = "email" class= "input-label"> Email</label>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>  
                               
   
    <!-- forms de senha -->
    <div class="form-group input-group" style="margin-top:35px;">
        <input type="password" required class= "input" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="exampleFormControlInput1 password"  value="<?php echo e(old('password')); ?>" required autocomplete="password" autofocus>
        <label for = "password" class= "input-label"> Senha</label>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                
    </div>
    <!-- botão -->
        <button type="submit" class="btn btn-secondary btn-lg btn-block container" style="background-color:#1D50A7;width: 25.9rem; margin-top: 20px"><?php echo e(__('LOGIN')); ?></button>
        
        
    
    
  </div>


    <div>
    <table class="container1" style=" ">
        <tr>
<!-- recuperar senha -->

        <td>
        <?php if(Route::has('password.request')): ?>
            <div>
                <a class="button btn-light" href="<?php echo e(route('password.request')); ?>" style="float: right; border:1px solid; padding: 11px 21px; vertical-align: middle;">ESQUECEU A SENHA</a>
            </div>
        </td>
        <?php endif; ?>
<!-- area de registro -->

    <?php if(Route::has('register')): ?>                                         
        <td>
            <div>
            <a class=" button btn-light " href="<?php echo e(route('register')); ?>" style="float: right; border:1px solid; padding: 11px 45px; vertical-align: middle;">REGISTRAR</a>
            </div>
        </td>
    <?php endif; ?>       
        </tr>
    </table>
</div>
</form>

<!-- texto do login -->
  <h6 class="container" style="  text-align: center; margin-top: 20px; color:#000; "></h6>

</div>
</div>

<div class="alin-direita">
    <img style="width: 35rem; height: 35rem" src="image/logos.png"/>
</div>



<div class="body-content" style="background-color: #000" >
    <footer class="fixarRodape" style="background-color: #000">
        <div class="my-auto" style="background-color: #000">
          <div class="copyright text-center my-auto">
            <a href="https://conselt.com.br" style="color: #FFF">Copyright &copy; CONSELT 2022</a>
          </div>
        </div>
    </footer>
</div>


<div class="box-parent-login">
	
</div>
</body>

<!-- Styles -->

<style>

.userimage{
    color: #000;
    background-color:transparent;
    width:100%;
}

.alin{
    
}

.container1 { 
    
    margin-left: auto;
    margin-right: auto; 
    margin-top: 50px;
}

/*FORM DE EMAIL */
.input-group{
    position:relative;
}
.input{
    padding:10px;
    border: none;
    font: inherit;
    color: #000;
    width: 100%;
    background-color:transparent;
    outline: 2px solid #1D50A7;
}
.input-label{
    position: absolute;
    top: 0;
    left: 0;
    transform: translate(10px,10px);
    transform-origin:left;
    transition: transform .25s
}
.input:focus+.input-label,
.input:valid+.input-label{
    transform:
    translate(0,-30px) scale(.8);
    color:#000;
}
.input:is(:focus,:valid){
    outline-color:#000;
}


/*-------------------------------------------------------------------------------*/
/*Button login*/


.cta{
    display: flex;
    align-items: center;
    color: #fff;
    background:none;
    border:none;
    padding: 12px 18px;
    position: relative;
}
.cta:before{
    content: "";
    position: absolute;
    top: 50%;
    transform: translateY(-50%) 
    translateX(calc(100% + 4px));
    width: 45px;
    height: 45px;
    background: #dc143c;
    border-radius: 50px;
    transition:transform .25s .25s 
    cubic-bezier(0,0,.5,2), width
    .25s cubic-bezier(0,0,.5,2);
    z-index: -1;

}

.cta:hover::before {
    width:100%;
    transform: translateY(-50%)
    translateX(-18px);
    transition: transform .25s
    cubic-bezier(0,0, .5,2),width 
    .25s .25s cubic-bezier(0,0,-5,2);
}

.cta i {
    margin-left:5px;
    transition:transform .25s .4s
    cubic-bezier(0,0,.5,2);
}
.cta:hover i {
    transform: translateX(3px);
}
/*-------------------------------------------------------------------------------*/
.background{
                background: url("image/fundo.png");
                background-attachment: fixed;
                background-size:100%;
                background-color:#000;
                background-repeat:no-repeat;
            }
            .alin-esquesrda{
             
            }
            .alin-direita{
                float:left;
                margin-left:6rem;
                margin-top:2rem;
            }
            .fixarRodape {
                bottom: 0;
                position: fixed;
                width: 100%;
                text-align: center;
    }
    .container_home{
        float:right;
        margin-right:7rem;
        margin-top:5rem;
        background: url("image/Brancof.png");
        background-attachment: fixed;
        background-size:100%;
        background-color:#000;
        background-repeat:no-repeat;
      
      
  }
  .animated-background{
    font-family: Verdana;
    background: linear-gradient( 
    to right, #1D50A7,
    #162436,#00C1A4);
    background-size: 400% 400%;
    animation: animate-background 10s infinite ease-in-out;
  }
  @keyframes  animate-background{
    0%{
        background-position: 0 50%;
    }
    50%{
        background-position: 100% 50%;
    }
    100%{
        background-position: 0 50%;
    }
  }

</style>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\fluxo-caixa-produto\resources\views/auth/login.blade.php ENDPATH**/ ?>