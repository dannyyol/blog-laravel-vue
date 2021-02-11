<template>
    <div>
            <section class="blog-list px-3 py-5 p-md-5">
                <form v-on:submit.prevent="handleSubmit" method="">
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

                            <!-- </div> -->
                            <!-- <multiselect
                                v-model="form.category_id"
                                :options="categories"
                                >
                            </multiselect> -->
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
        </section>
    </div>
</template>

<script>
import _ from 'lodash';
import MultiSelect, { Multiselect } from 'vue-multiselect';
Vue.component('Multiselect', Multiselect);
export default {
     props :['category_items'],

    created() {
        this.loadPost()
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
            let id = this.$route.params.id
                axios.patch('/api/post/'+id,this.form)
                .then(() => {
                    this.$router.push({ name: 'home'})
                })
                .catch(error =>this.errors = error.response.data.errors)
        
        },

        loadPost(){
            let id = this.$route.params.id
                axios.get( `/api/post/${this.$route.params.id}/edit`)
                .then((response) => {
                    console.log(response.data);
                    this.form = response.data
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
            
        }
    },
    
    computed:{
        currentPostItems(){
            // return this.items;
        }
    }
    
}
</script>