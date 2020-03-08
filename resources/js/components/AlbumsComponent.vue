<template>
	<div class="card bg-none m-3"  v-if="album.image[3]['#text'] != ''"   style="width: 14rem;">
	  <img class="card-img-top" :src="album.image[3]['#text']" alt="Card image cap">
	  <div class="card-body text-center">
	    <p class="album-title">{{ album.name }}</p>
	    <p class="album-artist">{{ album.artist }}</p>
	    <button class="btn btn-album-outline btn-rounded" @click="add" data-toggle="modal" data-target="#myListModal">Adicionar</button>
	  </div>
	</div>	
</template>

<script>
	export default {
		props:['album'],
		data() {
			return {

			}
		},
		methods: {
			add( ) {
				this.$emit('add')
			}
		}
	};
</script>