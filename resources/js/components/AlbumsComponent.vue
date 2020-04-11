<template>
<div>
	<div data-toggle="modal"  class="card bg-none m-3 album-card" @click="selectAlbum" v-if="album.image[3]['#text'] != ''"   style="width: 12rem;">
		<div class="img-center">
			<img class="card-img-top" :src="album.image[3]['#text']" alt="Card image cap">
		</div>
		<div class="mt-3 text-left">
			<p class="album-title">{{ album.name }}</p>
	    	<p class="album-artist">{{ album.artist }}</p>
	    <transition name="fade">
	    	  <button v-show="showName" v-if="isLoggedIn" class="btn btn-block btn-album-outline btn-rounded" @click="add" data-toggle="modal" data-target="#myListModal">Adicionar a Lista</button>
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
        padding: 0.5rem 1.5rem 0.5rem 1.5rem;
    }

    .fade-enter-active, .fade-leave-active {
      transition: all .8s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active em versões anteriores a 2.1.8 */ {
      opacity: 0;
    }
</style>