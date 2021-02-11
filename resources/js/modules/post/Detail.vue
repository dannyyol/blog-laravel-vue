<template>    
    <article class="blog-post px-3 py-5 p-md-5">
        <div class="container" v-for="post in posts.slice(0,1)" v-bind:key="post.id">
            <header class="blog-post-header">
                <h2 class="title mb-2">{{post.topic}}</h2>
                <div class="meta mb-3"><span class="date">Published 3 months ago</span><span class="time">5 min read</span><span class="comment"><a href="#">4 comments</a></span>
                <span class="comment"><a> <i class="fa fa-eye" aria-hidden="true"></i> {{ post.visit_count }} </a></span>
                    <!-- <a href=""><span class="fa fa-trash" aria-hidden="true"></span></a> -->
                </div>
                
            </header>

            <div class="blog-post-body">
                <figure class="blog-banner">
                    <a href=""><img class="img-fluid" :src="'/storage/images/'+post.photo" alt="image"></a>
                </figure>
                <!-- <p class="content-body" v-html="post.body"></p> -->
                <read-more class="content-body" more-str="read more" :text="post.body" link="#" less-str="read less" :max-chars="50"></read-more>                
                </div>
          <hr>
          <!-- comment -->
          <div class="comment-wrapper">
              <div class="card">
                    <div class="card-header bg-light">
                      Comment panel
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="buttonMode ? addComment():addReply()">
                            <div>
                                <div class="form-group" id='reply'>
                                    <label for>Fullname</label>
                                    <input
                                    type="text"
                                    name="fullname"
                                    class="form-control"
                                    v-model="form.fullname"
                                    :class="{'is-valid':form.errors.has('fullname')}"
                                    placeholder
                                    aria-describedby="helpId"
                                    />
                                    <has-error :form="form" field="fullname"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for>Email</label>
                                    <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    v-model="form.email"
                                    :class="{'is-valid':form.errors.has('email')}"
                                    placeholder
                                    aria-describedby="helpId"
                                    />
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label for="">Body</label>
                                <textarea v-model="form.body" type="text" name="body"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('body') }" placeholder ="Enter Bio">
                                </textarea>
                                <has-error :form="form" field="body"></has-error>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-info pull-right" v-show="!buttonMode">Reply</button>
                            <button type="submit" class="btn btn-info pull-right" v-show="buttonMode">Post</button>

                            </form>
                      <div class="clearfix"></div>
                      <hr>
                      <ul class="media-list">
                          <!-- <li class="media">
                              <a href="#" class="pull-left">
                                  <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                              </a>
                              <div class="media-body">
                                  <span class="text-muted pull-right">
                                      <small class="text-muted">30 min ago</small>
                                  </span>
                                  <strong class="text-success">@MartinoMont</strong>
                                  <p>
                                      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                      Lorem ipsum dolor sit amet, <a href="#">#consecteturadipiscing </a>.
                                  </p>
                              </div>
                          </li>
                          <li class="media">
                              <a href="#" class="pull-left"  style="padding-right:10px;">
                                  <img src="https://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle">
                              </a>
                              <div class="media-body">
                                  <span class="text-muted pull-right">
                                      <small class="text-muted">30 min ago</small>
                                  </span>
                                  <strong class="text-success">@LaurenceCorreil</strong>
                                  <p>
                                      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                      Lorem ipsum dolor <a href="#">#ipsumdolor </a>adipiscing elit.
                                  </p>
                              </div>
                          </li>
                          <li class="media">
                              <a href="#" class="pull-left">
                                  <img src="https://bootdey.com/img/Content/user_3.jpg" alt="" class="img-circle">
                              </a>
                              <div class="media-body">
                                  <span class="text-muted pull-right">
                                      <small class="text-muted">30 min ago</small>
                                  </span>
                                  <strong class="text-success">@JohnNida</strong>
                                  <p>
                                      Lorem ipsum dolor <a href="#">#sitamet</a> sit amet, consectetur adipiscing elit.
                                  </p>
                              </div>
                          </li> -->
                          <!-- added -->
                          <div v-for="(post, index) in posts.slice(1,2)" :key='index'>
                                <div v-for="(comment, index) in post" :key='index'>
                                    <li class="media">
                                        <a href="#" class="pull-left">
                                            <img src="https://bootdey.com/img/Content/user_3.jpg" alt="" class="img-circle">
                                        </a>
                                        <div class="media-body">
                                            <span class="text-muted pull-right">
                                                <small class="text-muted">30 min ago</small>
                                            </span>
                                            <strong class="text-success">@{{ comment.fullname }}</strong>
                                            <p v-text="comment.body">
                                                Lorem ipsum dolor <a href="#">#sitamet</a> sit amet, consectetur adipiscing elit.
                                            </p>

                                            <a href="#reply" @click='clickReply()'><i class="fa fa-reply text-success float-right" aria-hidden="true"></i></a>
                                        </div>
                                    </li>
                              </div>
                            
                            <!-- <li class="media reply">
                                <a href="#" class="pull-right">
                                    <img src="https://bootdey.com/img/Content/user_3.jpg" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                    <span class="text-muted pull-left">
                                        <small class="text-muted">30 min ago</small>
                                    </span>
                                    <strong class="text-success">@JohnNida</strong>
                                    <p>
                                        Lorem ipsum dolor <a href="#">#sitamet</a> sit amet, consectetur adipiscing elit.
                                    </p>
                                </div>
                            </li> -->
                          </div>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
    </article>
</template>
<style>
.reply{
    background-color: red !important;
}
.content-body img{
    width:100%;
}
</style>
<script>
import { VueEditor } from "vue2-editor";

export default {
  data() {
    return {
        buttonMode:true,
        form: new Form({
            fullname:'',
            email:'',
            body:''
        }),
        posts:[],
        comments:[],
        totallike:'',

      // person:this.$route.params.id
    };
  },
  methods: {
    loadPost() {
      let url = `/api/post/${this.$route.params.id}`
        axios.get(url).then(response => this.posts = response.data,response => this.p = response.data)   
        console.log(response.data.posts)   
    },
    addComment(){
        this.buttonMode = true;
        let url = `/api/post/create/${this.$route.params.id}`
        this.form.post(url)
            .then(response => {
                swal.fire({
                    title: "Success!",
                    text: "Comment Created",
                    icon: "success",
                    button: "Okay!",
                });
                this.loadPost();
                this.$router.push({name: 'detail'})  
            })
            .catch((error)=>{
                if(error.response){
                    swal.fire("Failed", "There was something wrong", "warning");
                    console.log('error', error.response)
                }
                
            });
    },
    clickReply(){
        this.buttonMode = false;
        console.log('reply me');
    },
    addReply(){
       
        this.buttonMode=true;
        let url = `/api/reply/create/${this.$route.params.id}`
        this.form.post(url)
            .then(response => {
                swal.fire({
                    title: "Success!",
                    text: "Reply Created",
                    icon: "success",
                    button: "Okay!",
                });
                this.loadPost();
                this.$router.push({name: 'detail'})
                // this.$router.push({name: 'home'})  
            })
            .catch((error)=>{
                if(error.response && buttonMode){
                    swal.fire("Failed", "There was something wrong", "warning");
                    console.log('error', error.response)
                }
                
            });
            this.buttonMode=true;
        console.log('submit reply');
    },

    likePost(){
        axios.post('/api/like/'+this.post,{post:this.post})
        .then(response =>{
            this.getlike()
            $('#success').html(response.data.message)
        })
        .catch()
    },
    getlike(){
        axios.post('/api/like',{post:this.post})
        .then(response =>{
            console.log(response.data.post.like)
            this.totallike = response.data.post.like
        })
    }
  },
  mounted() {
    this.loadPost();
    this.getlike();

        // this.loadComment();

    
  }
};


</script>
