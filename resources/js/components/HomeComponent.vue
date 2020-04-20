<template>
    <div class="container-fluid p-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 m-4 text-center">
                <h4 style="color: #fff">Busque pelos seus albums e os adicione já a sua lista!</h4>
            </div>  
        
               <!--  <div class="col-lg-4">
                  
                      <div class="form-group mx-sm-3 mb-2">
                          <input type="text" class="form-control" v-model="search" placeholder="Nome do Album ou Artista">
                        </div>
                        <button type="submit" class="btn btn-album-outline mb-2">Buscar</button>
                  
                </div>  -->
                <div class="col-lg-4 mx-auto">
                     <form @submit.prevent="searchAlbum">   
                       <!--  <div class="input-group">
                            <input type="text" class="form-control search-input" placeholder="Album ou artista..." v-model="search">
                            <span class="input-group-btn">
                                <button class="btn btn-album-outline btn-search" type="submit">Buscar</button>
                            </span>
                        </div> -->
                           <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text" v-model="search" class="form-control search-input" placeholder="Album ou artista...">
                            </div>
                    </form>
                </div>
            
            
        </div>
        <transition name="fade">
            <div v-show="show" class="row justify-content-center mt-2 p-3">
                <div class="col-lg-12 m-3 text-center">
                    <h4 style="color: #fff">{{ total }} resultados para <strong>{{ search }}</strong></h4>
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
                        <img width="50" :src="album.cover_big" alt="Card image cap"> 
                    </div>
                    <div class="col-xs-6 pt-2 pl-3">
                        <p style="font-size: 0.9rem; margin-bottom: -0.1rem"><strong>{{ album.title }}</strong></p>
                        <p style="font-size: 0.8rem">{{ album.artist.name }}</p>  
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
                total: 0,
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
                    q: this.search,
                    limit: 500,
                }

                try {

                    const response = await axios.get('https://cors-anywhere.herokuapp.com/https://api.deezer.com/search/album',{ params })

                   this.albums = response.data.data
                   this.total = response.data.total
                   this.show = true

                } catch(error) {
                    console.error("Olha o erro ai: ", error)
                }
                
            },

            async addToMyList(album) {
                this.my_list.push(album)

                this.removeAddedAlbum(album.id)
                
                try {
                    this.$store.dispatch('getUserFromLocalStorage')

                    const user = this.$store.getters.getUser

                    const params = {
                        'id': album.id,
                        'name': album.title,
                        'artist_name': album.artist.name,
                        'img': album.cover_big,
                        'user_id': user.id
                    }

                    const response = await axios.post("api/albums", params)

                } catch(error) {

                }
            },

            removeAddedAlbum(id) {
                this.albums = this.albums.filter(album => {
                    return album.id !== id
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
        line-height: 0.5rem;
        margin-bottom: 1rem;
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

    .search-input {
        height: auto;
        border-radius: 50px;
    }

    .has-search .form-control {
        padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
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