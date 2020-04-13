<template>
	<div @click="selectAlbum" class="card bg-none m-3 album-card" style="width: 12rem;">
		<div class="img-center">
			<!-- <img class="card-img-top" :src="album.image[3]['#text']" alt="Card image cap"> -->
			<img class="card-img-top" :src="item.img" alt="Card image cap">
		</div>
		<div class="mt-3 text-left">
			<p class="album-title">{{ item.name }}</p>
	    	<p class="album-artist">{{ item.artist_name }}</p>
	    	<transition name="fade">
		    	<div v-show="showButtons" class="mt-3">
		    		<button class="btn btn-outline-primary btn-sm mr-2 btn-rounded">Já ouvi</button>
		    		<button class="btn btn-outline-danger btn-sm btn-rounded">Remover</button>
		    	</div>
	    	</transition>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['item'],
		data() {
			return {
				showButtons: false,
			}
		},
		methods: {
			selectAlbum() {
				this.showButtons = !this.showButtons
			}
		},
	};
</script>