<template>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-3 mt-5">
                 <observer v-slot="{ handleSubmit }">
    				<form @submit.prevent="handleSubmit(login)">
    					<div class="col-lg-12 mt-3 p-2 text-center">
    						<h3 style="color: #fff">Entrar</h3>
    					</div>
        				<div class="form-group">
        					<google-login class="btn btn-google-outline mb-2 btn-block" :params="params" :onSuccess="googleLoginSuccess" :onFailure="googleLoginFailure" type="button"><i class="fab fa-google google-icon"></i>Entrar com o <b>Google</b></google-login>
        					<p class="or"><span><i>ou</i></span></p>
                        </div>
                        <div class="form-group">
                            <div class="alert alert-danger mt-2" v-show="error" role="alert">
                                {{ message }}
                            </div>
                        </div>
    					<div class="form-group">
                            <validation  name="email" rules="required|email" v-slot="{ errors }">
                                <input class="form-control" v-bind:class="{ 'is-invalid': errors[0]}" placeholder="Email" v-model="email" type="text">
                                <span class="invalid-feedback">{{ errors[0] }}</span>
                            </validation>

    					</div>
    					<div class="form-group">
                            <validation  name="password" rules="required" v-slot="{ errors }">
                                <input type="password" v-model="password" class="form-control" v-bind:class="{ 'is-invalid': errors[0]}" placeholder="Senha">
                                <span class="invalid-feedback">{{ errors[0] }}</span>
                            </validation>
    							
    					</div>
    					<div class="form-group">
    						<button type="submit" class="btn btn-album-outline mb-2 btn-block">Entrar</button>
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
                email: '',
                password: '',
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
        		
        		console.log(googleResponse.access_token)

        		try {
                    axios.get('/airlock/csrf-cookie').then(async () => {
            			const response = await axios.post("api/social-login", { access_token: googleResponse.access_token})

                        const data = response.data
            			
                        this.$store.dispatch('login', data)
                        this.$router.push('list')

                        this.error = false
                    })
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

            async login() {
                try {
                    axios.get('/airlock/csrf-cookie').then(async () => {
                        const params = {
                            'email': this.email,
                            'password': this.password
                        }

                        const response = await axios.post("api/login", params)

                        const data = response.data
                        
                        this.$store.dispatch('login', data)
                        this.$router.push('list')

                        this.error = false
                    })
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
	.is-invalid {
        border-width: 2px;
    }

    .invalid-feedback {
        font-size: 0.8rem;
        text-align: center;
        padding: 0.1rem;
    }

    .alert-danger {
        color: #fff;
        background-color: #e3342f;
        border-color: #e3342f;
    }
</style>