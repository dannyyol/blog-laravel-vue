<template>
    <div>
        <section class="cta-section theme-bg-light py-5">
            <div class="container text-center">
                <h2 class="heading">DevBlog - A Blog Template Made For Developers</h2>
                <div class="intro">Welcome to my blog. Subscribe and get my latest blog post in your inbox.</div>
                <form class="signup-form form-inline justify-content-center pt-3">
                    <div class="form-group">
                        <label class="sr-only" for="semail">Your email</label>
                        <input type="text" id="semail" name="semail1" class="form-control mr-md-1 semail" v-model="searchPost" placeholder="Search">

                        <!-- <input type="email" id="semail" name="semail1" class="form-control mr-md-1 semail" placeholder="Enter email"> -->
                        
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Subscribe</button> -->
                </form>
            </div><!--//container-->
        </section>

        <!-- <nav-component :searchMethod="filterSearch" @searchPost="filterSearch"></nav-component> -->
        <!-- <input type="text" name="" v-model="searchPost" id=""> -->
        <section class="blog-list px-3 py-5 p-md-5">
            <card-component>
                <template slot="top">
                    <div class="item mb-5" v-for="item in filterSearch" :key="item.id">
                        <div class="media">
                            <!-- <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="assets/images/blog/blog-post-thumb-1.jpg" alt="image"> -->
                            <img class="mr-3 img-fluid post-thumb d-none d-md-flex" :src="'storage/images/'+item.photo" alt="image">
                            <div class="media-body">
                                <h3 class="title mb-1" v-text="item.topic"><a href="blog-post.html">
                                    <!-- Why Every Developer Should Have A Blog -->
                                    </a>
                                </h3>
                                    
                                <div class="meta mb-1"><span class="date">Published 2 days ago</span><span class="time">5 min read</span><span class="comment"><a href="#">Comments: {{ item.comments.length }}</a></span>
                                    <div class="float-right" v-if="auth_user">
                                        <span class="comment"> 
                                            <!-- <router-link class="more-link" :to="{ path: '/edit/'+item.id +'/'+ item.slug}"> -->
                                            <router-link class="more-link" :to="{name: 'PostAdd', params:{id:item.id, slug:item.slug}}">
                                                <i class="fas fa-edit"></i> Edit
                                            </router-link>
                                        </span>
                                        <a href="#" @click="deletePost(item.id)" class="text-danger"> <span class="fa fa-trash" aria-hidden="true"></span> Delete</a>
                                    </div>

                                    <router-link class="text-success" ></router-link>
                                </div>
                                <div v-if="item.body > 50">
                                    <div class="intro" v-html="item.body.substring(0,100)+'...' "></div>
                                </div>
                                <div v-else> 
                                    <div class="intro" v-html="item.body.substring(0,100)+'...' "></div>
                                    <!-- <div class="intro" v-html="item.body | snippet "></div> -->
                                </div>
                                <router-link class="more-link" :to="{name: 'detail', params:{id:item.id, slug:item.slug}}">Read more &rarr;</router-link> 

                                <!-- <router-link class="more-link" :to="{ path: '/post/'+item.id +'/'+ item.slug}" name id>Read more &rarr;</router-link> -->
                            </div><!--//media-body-->
                        </div><!--//media-->
                    </div><!--//item-->
                </template>

                <template slot="next">
                    <nav class="blog-nav nav nav-justified my-5">
                        <a class="nav-link-prev nav-item nav-link d-none rounded-left" href="#">Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
                        <a class="nav-link-next nav-item nav-link rounded" href="blog-list.html">Next<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
                    </nav>
                </template>
            </card-component>
            

        </section>

    </div>
</template>
<style>
    a.router-link-exact-active{
        color:black;
    }
</style>
<script>
import _ from 'lodash';
import PostAdd from './PostAdd.vue'

    export default {
        props:['items', 'auth_user'],
        data(){
            return{
                searchPost: '',
                posts:[]
                // img_src:'storage/images',
            }
        },
        methods:{
            deletePost(id){
                swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                // will send request to the server
                if (result.value) {
                    this.$axios.delete('api/post/'+ id).then(()=>{
                        swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                        Fire.$emit('AfterCreated'); //load all users after creating user

                    }).catch(()=>{
                        swal.fire("Failed", "There was something wrong", "warning");
                    });
                }
            })
        },
            
            // loadPosts(){
            //     let url = `/api/post`
            //     return this.$axios.get(url).then(response => this.posts = response.data,response => this.p = response.data)               }
            
        },
        computed:{
            // currentPostItems(){
            //     return this.items;
            // },

            filterSearch(){
                return this.items.filter(item => {
                    return item.topic.match(this.searchPost)
                }) 
            }
        },
        created(){
            Fire.$on('AfterCreated', () => {
                // this.currentPostItems(); 
            this.filterSearch;
            });
            console.log(this.items);
        }
    }
</script>
