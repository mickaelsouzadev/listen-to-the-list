<template>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-3 mt-5">
				<form >
					
					<div class="col-lg-12 mt-3 p-2 text-center">
						<h3 style="color: #fff">Cadastre-se</h3>
					</div>
					<div class="form-group">
						<GoogleLogin class="btn btn-google-outline mb-2 btn-block" :params="params" :onSuccess="googleLoginSuccess" :onFailure="googleLoginFailure"  type="button"><i class="fab fa-google google-icon"></i> Cadastre-se com o <b>Google</b></GoogleLogin>
					</div>
					<p class="or"><span><i>ou</i></span></p>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Nome Completo">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Senha">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Repetir senha">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-album-outline mb-2 btn-block">Cadastrar</button>
					</div>
				
				</form>
			</div>		
		</div>
	</div>
</template>

<script>
	import GoogleLogin from 'vue-google-login';

    export default {
    	data() {
            return {
                // client_id is the only required property but you can add several more params, full list down bellow on the Auth api section
                params: {
                    client_id: "650637100521-valep46gskagmirmhmpl8ovrifnjv8s6.apps.googleusercontent.com"
                },
                // only needed if you want to render the button with the google ui
                renderParams: {
                    width: 350,
                    height: 50,
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
        	async googleLoginSuccess(googleUser) {
        	    const googleResponse = googleUser.getAuthResponse(true);
        		
        		console.log(googleResponse.access_token)

        		try {
        			const response = axios.post("http://localhost:8000/social-register", { access_token: googleResponse.access_token})

        			console.log(response)
        		} catch(error) {
        			console.error("Olha ai deu ruim: ", error)
        		}
        	   
        	},

        	googleLoginFailure() {
        		console.error('Deu Ruim');
        	},

        	async defaultLogin() {
        		console.log('A');
        	}
        },
        components: {
            GoogleLogin
        }
    };
</script>

 <style type="text/css">
 	.or {
 		width: 100%; 
	   text-align: center; 
	   border-bottom: 1px solid #fff; 
	   line-height: 0.2em;
	   margin: 10px 0 20px; 
 	}

 	.or span { 
	    background:#222f3e;
	    color: #fff;
	    padding:0 10px; 
	}

	.btn-google-outline {
        background-color: transparent;
        border: 2px solid #d9534f;
        color: #d9534f;
    }

    .btn-google-outline:active, .btn-google-outline:focus, .btn-google-outline:hover {
        background-color: #d9534f;
        color: #fff;
    }

    .google-icon {
    	margin-left: -3rem;
    	margin-right: 1rem;
    }
 </style>