<template>
    <div class="container fluid p-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 m-4 text-center">
                <h4 style="color: #fff">Busque pelos seus albums e os adicione já a sua lista!</h4>
            </div>    
            <div class="col-lg-4">
               <form @submit.prevent="searchAlbum" class="form-inline">
                  <div class="form-group mx-sm-3 mb-2">
                      <input type="text" class="form-control" v-model="search" placeholder="Nome do Album ou Artista">
                    </div>
                    <button type="submit" class="btn btn-album-outline mb-2">Buscar</button>
               </form>
            </div>
        </div>
        <div v-show="show" class="row justify-content-center mt-5 p-3">
           <div class="card bg-none m-3" v-for="album in albums" v-if="album.image[3]['#text'] != ''" style="width: 14rem;">
             <img class="card-img-top" :src="album.image[3]['#text']" alt="Card image cap">
             <div class="card-body text-center">
               <p class="album-title">{{ album.name }}</p>
               <p class="album-artist">{{ album.artist }}</p>
               <button class="btn btn-album-outline btn-rounded">Adicionar</button>
             </div>
           </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                search: "",
                albums: null,
                show: false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            async searchAlbum() {

                const params = {
                    method: 'album.search',
                    album: this.search,
                    api_key: 'YOUR_API_KEY',
                    format: 'json'
                }

                try {

                    const response = await axios.get('http://ws.audioscrobbler.com/2.0/', { params })

                   this.albums = response.data.results.albummatches.album
                   this.show = true

                   console.log(this.albums)
                } catch(error) {
                    console.error("Olha o erro ai: ", error)
                }
                
            },

        
        }

       
    };
</script>

<style type="text/css">
    .card {
        border: none;
        border-radius: 0;
        color: #10ac84;
    }

    .card-img, .card-img-top {
        border-radius: 0;
    }

    .album-title {
        font-size: 1rem;
        font-weight: 500;
        font-family: 'Roboto', sans-serif;
    }

    .album-artist {
        font-size: 1rem;
        font-family: 'Roboto', sans-serif;
    }

    .bg-none {
        background-color: transparent;
    }

    .btn-album {
        background-color: #10ac84;
        color: #fff;
    }

    .btn-album:active, .btn-album:focus, .btn-album:hover {
        background-color: #10ac84;
        color: #fff;
    }

    .btn-album-outline {
        background-color: transparent;
        border: 2px solid #10ac84;
        color: #10ac84;
    }

    .btn-album-outline:active, .btn-album-outline:focus, .btn-album-outline:hover {
        background-color: #10ac84;
        color: #fff;
    }

    .btn-rounded {
        border-radius: 50px;
    }
</style>