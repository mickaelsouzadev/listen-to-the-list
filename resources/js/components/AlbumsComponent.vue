<template>
<div>
	<div class="card bg-none m-3 album-card" @click="selectAlbum" style="width: 12rem;">
		<div class="img-center">
			<img class="card-img-top" :src="album.cover_big" alt="Card image cap">
		</div>
		<div class="mt-3 text-left">
			<p class="album-title">{{ album.title }}</p>
	    	<p class="album-artist">{{ album.artist.name }}</p>
	    <transition name="fade">
	    	  <button v-show="showName" v-if="isLoggedIn" class="btn btn-block btn-album-outline btn-rounded btn-add-album" @click="add" data-toggle="modal" data-target="#myListModal">Adicionar a Lista</button>
	    </transition>
	  
		</div>
	</div>
	
</div> 	
</template>

<script>
	export default {
		props:['album'],
		data() {
			return {
				showName: false,
			}
		},
		methods: {
			add() {
				this.$emit('add')
			},

			selectAlbum() {
				this.showName = !this.showName
			}
		},
		computed: {
			isLoggedIn () {
           		return this.$store.getters.getIsLoggedIn
           }
		}
	};
</script>

<style type="text/css">

	.album-card {
      cursor: pointer;
	}

	.card-img-top {
      border-radius: 8%;

	}

	.btn-rounded {
        border-radius: 50px;
       	padding: 0.5rem 1rem 0.5rem 1rem;
    }

    .btn-add-album {
    	padding: 0.5rem 1.5rem 0.5rem 1.5rem;
    }

    .fade-enter-active, .fade-leave-active {
      transition: all .8s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active em versões anteriores a 2.1.8 */ {
      opacity: 0;
    }
</style>