<template>
	<div class="container-fluid p-5">
		<!-- <div class="row">
			<div class="col-lg-4 row list-album">
				
				<img class="list-img" src="https://lastfm.freetls.fastly.net/i/u/300x300/e89712ce64e748e2960135803cea6160.png"/>
			
				<div class="col-lg-8 list-text">
					<p class="album-title">Music for the Masses</p>
					<p class="album-artist">Depeche Mode</p>
				</div>
			</div>
			<div class="col-lg-4 row list-album">
				
				<img class="list-img" src="https://lastfm.freetls.fastly.net/i/u/300x300/e89712ce64e748e2960135803cea6160.png"/>
			
				<div class="col-lg-8 list-text">
					<p class="album-title">Music for the Masses</p>
					<p class="album-artist">Depeche Mode</p>
				</div>
			</div>	
			<div class="col-lg-4 row list-album">
				
				<img class="list-img" src="https://lastfm.freetls.fastly.net/i/u/300x300/e89712ce64e748e2960135803cea6160.png"/>
			
				<div class="col-lg-8 list-text">
					<p class="album-title">Music for the Masses</p>
					<p class="album-artist">Depeche Mode</p>
				</div>
			</div>	
			<div class="col-lg-4 row list-album">
				
				<img class="list-img" src="https://lastfm.freetls.fastly.net/i/u/300x300/e89712ce64e748e2960135803cea6160.png"/>
			
				<div class="col-lg-8 list-text">
					<p class="album-title">Music for the Masses</p>
					<p class="album-artist">Depeche Mode</p>
				</div>
			</div>	
			<div class="col-lg-4 row list-album">
				
				<img class="list-img" src="https://lastfm.freetls.fastly.net/i/u/300x300/e89712ce64e748e2960135803cea6160.png"/>
			
				<div class="col-lg-6 list-text">
					<p class="album-title">Music for the Masses</p>
					<p class="album-artist">Depeche Mode</p>
				</div>

			</div>		
		</div> -->
		<div  class="row justify-content-center mt-2 p-3">
			<item-component v-for="item in items" v-bind:key="item.id" :item="item"></item-component>
		</div>

	</div>

	
</template>

<style type="text/css">
	.list-img {
		width: 80px;
		height: 80px;
		border-radius: 8%;
	}

	.list-text {
		color: #fff;
		margin-top: 1rem;
		width: auto;
	}

	.list-album {
		margin: 0rem 0rem 1.8rem 0rem;
	}
</style>

<script>
	export default {
		data() {
			return {
				showButtons: false,
				items: [],
			}
		},
		methods: {
			
		},
		mounted() {
			this.$store.dispatch('getUserFromLocalStorage')

			const id = this.user.id
			
			axios.get('/airlock/csrf-cookie').then(()=> {
				axios.get(`api/list/${id}`).then(response => {
					this.items = response.data
					console.log(this.items)
				})
			})
		},
		computed: {
			user () {
           		return this.$store.getters.getUser
           }
		}
	};
</script>
