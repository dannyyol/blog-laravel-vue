<template>
    <div>
        <div v-if="auth_user">
        <!-- <nav-component></nav-component> -->
            <section class="blog-list px-3 py-5 p-md-5">
                <div v-if="$route.name=='create'">
                    <h3>Create Post</h3>
                </div>
                <div v-else>
                    <h3>Edit Post</h3>
                </div>
                
                <form>
                <!-- <form v-on:submit.prevent="updatePost" method="" v-show="$route.name=='detail'"> -->
                    <div class="form-container">
                        <div class="form-group">
                            <label for>Topic</label>
                            <input
                            type="text"
                            name="topic"
                            class="form-control"
                            v-model="form.topic"
                            placeholder
                            aria-describedby="helpId"
                            />
                              <small class="text-danger" v-if="errors.topic"> {{ errors.topic[0] }} </small> 
                        </div>
                        <div class="form-group">
                            <!-- <div class="form-group"> -->
                             <label for="">Category</label>
                            <select style="height:50px;" class="form-control" v-model="form.category_id" id="">
                                <option value="">---select category----</option>
                                <option v-for="(item,index) in category_items" :key="index" :value="item.id"  > {{item.name}} </option>
                            </select>
                            <small class="text-danger" v-if="errors.category_id"> {{ errors.category_id[0] }} </small> 

                        </div>
                        <div class="form-group">
                            <label for="">Body</label>
                            <vue-editor v-model="form.body"></vue-editor>
                            <small class="text-danger" v-if="errors.body"> {{ errors.body[0] }} </small> 
                        </div>
                        <div class="form-group">
                        <label for="">Featured Image</label>
                            <input type="file" class="form-control-file" @change="AddImage" name="photo" id="" placeholder="" aria-describedby="fileHelpId">
                        </div>
                            <div>                            
                                <button type="submit" @click.prevent="handleSubmit()" class="btn btn-primary">Create Post</button>
                            </div>
                    </div>
                </form>
        </section>
    </div>
    <div v-else >
        <h1 align="center">You Not Authorize To Access This Page</h1>
    </div>
        
    </div>
    
</template>

<script>
import _ from 'lodash';
import MultiSelect, { Multiselect } from 'vue-multiselect';
import { VueEditor } from "vue2-editor";

Vue.component('Multiselect', Multiselect);
export default {
    props :['category_items', 'auth_user'],
    components: {
        MultiSelect
    },
    data() {
        return {
            form :{
                topic:'',
                category_id:'',
                body:'',
                photo:''
            },
            errors:{},
            post: null,
            categories: []
        }
    },
    methods: {

        handleSubmit(){
                axios.post('api/post',this.form)
                .then(() => {
                    this.$router.push({ name: 'home'})
                })
                .catch(error =>this.errors = error.response.data.errors)
        
        },

        AddImage(e){
            // Base64 for encoding photo file
            let file = e.target.files[0];
            let reader = new FileReader();

            if(file['size'] < 2111775){
              reader.onloadend = (file) => {
              // console.log('RESULT', reader.result)
              this.form.photo = reader.result
              }
              reader.readAsDataURL(file);

            }else{
                // swal.fire({
                //   type: 'error',
                //   title :'Oops...',
                //   text: 'You are uploading a large file',
                // })
            }
            
        },

        loadPosts(){  
            axios.get('api/post').then(( {data} ) => (this.posts = data)); 
        },
        updatePost(){
            console.log('Form Data', this.form);
            let url = `/api/post/${this.$route.params.id}`
            this.form.put(url).then(response => this.post = response.data,response => this.p = response.data)
            .then(response => {
                    // console.log('response, reponse.data');
                    // window.location.href = "./";
                    this.$router.push({name: 'home'})  
                    this.loadPosts();                 
                })
                .catch(error => console.log('error', error.response));   
        },

        createPost(){
            if(this.auth_user){
                let url = `/api/post`
                this.form.post(url).then(response => this.post = response.data,response => this.p = response.data)
                .then(response => {
                    // console.log('response, reponse.data');
                    // window.location.href = "./";
                    this.$router.push({name: 'home'})  
                    this.loadPosts();                 
                })
                .catch(error => console.log('error', error.response));  
            }
             

        }
    },
    
    // computed:{
    //     currentRouteName() {
    //         return this.$route.name;
    //     },
    
    // }
    mounted(){
        axios.get(`/api/post/${this.$route.params.id}`)
          .then(({ data }) => (this.form.fill(data)))
        // console.log(this.form.fill(data));
    }
    
}
</script>
