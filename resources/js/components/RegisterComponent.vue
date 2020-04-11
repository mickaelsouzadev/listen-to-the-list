<template>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-3 mt-5">
            <observer v-slot="{ handleSubmit }">
				<form @submit.prevent="handleSubmit(register)">
					
					<div class="col-lg-12 mt-3 p-2 text-center">
						<h3 style="color: #fff">Cadastre-se</h3>
					</div>
					<div class="form-group">
						<google-login class="btn btn-google-outline mb-2 btn-block" :params="params" :onSuccess="googleLoginSuccess" :onFailure="googleLoginFailure"  type="button"><i class="fab fa-google google-icon"></i> Cadastre-se com o <b>Google</b></google-login>
					</div>
					<p class="or"><span><i>ou</i></span></p>
                    <div class="form-group">
                        <div class="alert alert-danger mt-2" v-show="error" role="alert">
                            {{ message }}
                        </div>
                    </div>
					<div class="form-group">
                        <validation  name="name" rules="required" v-slot="{ errors }">
						  <input type="text" class="form-control" v-bind:class="{ 'is-invalid': errors[0]}" v-model="userParams.name" placeholder="Nome Completo">
                           <span class="invalid-feedback">{{ errors[0] }}</span>
                        </validation>
					</div>
					<div class="form-group">
                        <validation  name="email" rules="required|email" v-slot="{ errors }">
                            <input class="form-control" v-bind:class="{ 'is-invalid': errors[0]}" v-model="userParams.email" placeholder="Email">
                            <span class="invalid-feedback">{{ errors[0] }}</span>
                        </validation>
						
					</div>
                    <observer>
    					<div class="form-group">
                            <validation name="password" rules="required|confirmed:repeatPassword" v-slot="{ errors }">
                                <input type="password" class="form-control" v-bind:class="{ 'is-invalid': errors[0]}" v-model="userParams.password" placeholder="Senha">
                                <span class="invalid-feedback">{{ errors[0] }}</span>
                            </validation>
    						
    					</div>
    					<div class="form-group">
                            <validation  name="repeat-password" rules="required" v-slot="{ errors }" vid="repeatPassword">
                                <input type="password" class="form-control" v-model="userParams.repeatPassword" v-bind:class="{ 'is-invalid': errors[0]}" placeholder="Repetir senha">
                                <span class="invalid-feedback">{{ errors[0] }}</span>
                            </validation>
    						
    					</div>
                    </observer>
					<div class="form-group">
						<button type="submit" class="btn btn-album-outline mb-2 btn-block">Cadastrar</button>
					</div>
				
				</form>
            </observer>
			</div>		
		</div>
	</div>
</template>

<script>
	
    export default {
    	data() {
            return {
                params: {
                    client_id: this.$store.getters.getGoogleClientId
                },
                userParams: {
                    name: '',
                    email: '',
                    password: '',
                    repeatPassword: '',
                },
                error: false,
                message: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
        	async googleLoginSuccess(googleUser) {
        	    const googleResponse = googleUser.getAuthResponse(true);
        
        		try {
        			const response = await axios.post("api/social-register", { access_token: googleResponse.access_token})

        			const data = response.data
                    
                    this.error = false

                    this.$store.dispatch('login', data)
                    this.$router.push('home')
                    
        		} catch(error) {
        			const response = error.response

                    if(response.status === 401) {
                        this.error = true
                        this.message = response.data.message
                    }
        		}
        	   
        	},

        	googleLoginFailure() {
        		this.error = true
                this.message = "Não foi possível realizar o login na sua conta google"
        	},

        	async register() {
        		try {
                    const response = await axios.post("api/register", this.userParams)

                    const data = response.data
                    
                    this.error = false

                    this.$store.dispatch('login', data)
                    this.$router.push('home')

                } catch(error) {
                    const response = error.response

                    if(response.status === 401) {
                        this.error = true
                        this.message = response.data.message
                    }
                }
        	}
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
	    background:#020916;
	    color: #fff;
	    padding:0 10px; 
	}

	.btn-google-outline {
        background-color: transparent;
        border: 2px solid #e22225;
        color: #e22225;
    }

    .btn-google-outline:active, .btn-google-outline:focus, .btn-google-outline:hover {
        background-color: #e22225;
        color: #fff;
    }

    .google-icon {
    	margin-left: -3rem;
    	margin-right: 1rem;
    }
 </style>