<template>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-3 mt-5">
				<form>
					<div class="col-lg-12 m-3 p-2 text-center">
						<h3 style="color: #fff">Entrar</h3>
					</div>
					<div class="form-group">
						<GoogleLogin :params="params" :renderParams="renderParams" :onSuccess="googleLoginSuccess" :onFailure="googleLoginFailure">Entrar com o Google</GoogleLogin>
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