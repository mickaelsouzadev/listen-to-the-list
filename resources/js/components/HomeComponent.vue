<template>
    <div class="container-fluid p-5">
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
        <transition name="fade">
            <div v-show="show" class="row justify-content-center mt-2 p-3">
                <div class="col-lg-12 m-3 text-center">
                    <h4 style="color: #fff">Resultados para <strong>{{ search }}</strong></h4>
                </div>
               <albums-component v-for="album in albums" v-bind:key="album.mbid" :album="album" @add="addToMyList(album)" ></albums-component>
            </div>
        </transition>
        <div class="modal" id="myListModal" tabindex="-1" role="dialog" aria-labelledby="myListModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-custom">
                <h5 class="modal-title">Minha Lista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row pl-4" v-for="album in my_list">
                    <div class="col-xs-6">
                        <img width="50" :src="album.image[1]['#text']" alt="Card image cap"> 
                    </div>
                    <div class="col-xs-6 pt-2 pl-3">
                        <p style="font-size: 0.9rem; margin-bottom: -0.1rem"><strong>{{ album.name }}</strong></p>
                        <p style="font-size: 0.8rem">{{ album.artist }}</p>  
                    </div>
                   
                </div>
              </div>
              
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
                my_list: [],
                albums: null,
                show: false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            async searchAlbum() {

                this.albums = null
                this.show = false

                const params = {
                    method: 'album.search',
                    album: this.search,
                    api_key: 'LAST_FM_API_KEY',
                    format: 'json'
                }

                try {

                    const response = await axios.get('http://ws.audioscrobbler.com/2.0/',{ params })

                   this.albums = response.data.results.albummatches.album
                   this.show = true

                } catch(error) {
                    console.error("Olha o erro ai: ", error)
                }
                
            },

            async addToMyList(album) {
                this.my_list.push(album)

                this.removeAddedAlbum(album.mbid)
                
                try {
                    this.$store.dispatch('getUserFromLocalStorage')

                    const user = this.$store.getters.getUser

                    const params = {
                        'id': album.mbid,
                        'name': album.name,
                        'artist_name': album.artist,
                        'img': album.image[3]['#text'],
                        'user_id': user.id
                    }

                    const response = await axios.post("api/albums", params)

                } catch(error) {

                }
            },

            removeAddedAlbum(id) {
                this.albums = this.albums.filter(album => {
                    return album.mbid !== id
                })

                console.log(this.albums)
            }
           
        }

       
    };
</script>

<style type="text/css">
    .card {
        border: none;
        border-radius: 0;
        color: #12b751;
    }

    .card-img, .card-img-top {
        border-radius: 0;
    }

    .album-title {
        font-size: 1rem;
        font-weight: 500;
        font-family: 'Roboto', sans-serif;
        color: #fff;
    }

    .album-artist {
        font-size: 0.9rem;
        font-family: 'Roboto', sans-serif;
        color: #12b751;
    }

    .bg-none {
        background-color: transparent;
    }

    .btn-album {
        background-color: #12b751;
        color: #fff;
    }

    .btn-album:active, .btn-album:focus, .btn-album:hover {
        background-color: #12b751;
        color: #fff;
    }

    .btn-album-outline {
        background-color: transparent;
        border: 2px solid #12b751;
        color: #12b751;
    }

    .btn-album-outline:active, .btn-album-outline:focus, .btn-album-outline:hover {
        background-color: #12b751;
        color: #fff;
    }

    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        border-radius: 0;
        border: none;
        color: #fff;
    }
</style>