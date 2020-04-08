<template>
<div>
	<div data-toggle="modal"  class="card bg-none m-3 album-card" @click="selectAlbum" v-if="album.image[3]['#text'] != ''"   style="width: 12rem;">
		<div class="img-center">
			<img class="card-img-top" v-bind:class="{ small: showName}" :src="album.image[3]['#text']" alt="Card image cap">
		</div>
		<div class="mt-3 text-left">
			<p class="album-title">{{ album.name }}</p>
	    	<p class="album-artist">{{ album.artist }}</p>
	    <button v-show="showName" v-if="isLoggedIn" class="btn btn-block btn-album-outline btn-rounded" @click="add" data-toggle="modal" data-target="#myListModal">Adicionar a Lista</button>
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
	
	.img-center {
   
	}

	.card-body {
		float: left;
	}

	.album-card {
      cursor: pointer;
	}

	.card-img-top {
		webkit-transition: all 400ms ease-out;
      -moz-transition: all 400ms ease-out;
      -o-transition: all 400ms ease-out;
      -ms-transition: all 400ms ease-out;
      transition: all 400ms ease-out;
      float:left;

	}

	.small {
		width: 85%;
	}

	.big {
		width: 18rem;
	}

	.btn-rounded {
        border-radius: 50px;
        padding: 0.12rem 1.5rem 0.12rem 1.5rem;
        width: 85%;
    }

</style>