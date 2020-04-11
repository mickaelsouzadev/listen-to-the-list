<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-custom">
	        <a class="navbar-brand navbar-title" href="/">Listen to the List</a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
          	</button>
	        <div class="collapse navbar-collapse nav-right" id="navbarNav">
	            <ul class="navbar-nav">
	              <!-- <li class="nav-item">
	                <router-link class="nav-link" to="/albums">Albuns</router-link>
	              </li> -->
	              <li v-if="isLoggedIn" class="nav-item">
	                <router-link class="nav-link" to="list">Minha Lista</router-link>
	              </li>
	              <li v-if="isLoggedIn" class="nav-item">
	                <a class="nav-link" href="#" @click="logout">Sair</a>
	              </li>
	              <li v-if="!isLoggedIn" class="nav-item">
	                <router-link class="nav-link" to="register">Cadastre-se</router-link>
	              </li>
	              <li v-if="!isLoggedIn" class="nav-item">
	                <router-link class="nav-link" to="login">Entrar</router-link>
	              </li>
	            </ul>
	        </div>
        </nav>
    </div>
</template>

<script>
    export default {
    	data () {
    		return {
    			user: [],
    		}
    	},
        computed: {
           isLoggedIn () {
           		return this.$store.getters.getIsLoggedIn
           }
        },
        methods: {
        	logout () {
    		 	this.$store.dispatch('logout')
    		 	this.$router.push('/')
        	}
        }
    };
</script>

<style type="text/css">
	
	body {
		background-color: #020916;
	}

    .bg-custom {
        background-color: #12b751;
    }

    .navbar-title {
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        font-size: 1.4rem;
    }

   	.navbar-dark .navbar-nav .nav-link {
    	color: #fff;
    	font-size: 1.2rem;
	}

	.navbar-dark .navbar-nav .nav-link:hover {
   		background-color: #fff;
   		color: #12b751;
	}

	.nav-right {
		margin-left: 55%;
	}
</style>