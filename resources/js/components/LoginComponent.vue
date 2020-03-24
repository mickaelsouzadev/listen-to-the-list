<template>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-3 mt-5">
				<form>
					<div class="col-lg-12 mt-3 p-2 text-center">
						<h3 style="color: #fff">Entrar</h3>
					</div>
					<div class="form-group">
						<GoogleLogin class="btn btn-google-outline mb-2 btn-block" :params="params" :onSuccess="googleLoginSuccess" :onFailure="googleLoginFailure" type="button"><i class="fab fa-google google-icon"></i>Entrar com o <b>Google</b></GoogleLogin>
						<p class="or"><span><i>ou</i></span></p>
						<div class="form-group">
								<input type="email" class="form-control" placeholder="Email">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Senha">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-album-outline mb-2 btn-block">Entrar</button>
						</div>
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
                    client_id: "GOOGLE_CLIENT_ID"
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
        		console.log('Caiu aqui');
        	    const googleResponse = googleUser.getAuthResponse(true);
        		
        		console.log(googleResponse.access_token)

        		try {
        			const response = axios.post("http://localhost:8000/test-socialite", { access_token: googleResponse.access_token})

        			console.log(response)
        		} catch(error) {
        			console.error("Olha ai deu ruim: ", error)
        		}
        	   
        	},
        	googleLoginFailure() {
        		console.error('Deu Ruim');
        	}
        },
        components: {
            GoogleLogin
        }
    };
</script>

<style type="text/css">
	
</style>