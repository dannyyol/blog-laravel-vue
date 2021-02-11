<template>
<section class="cta-section theme-bg-light py-5">
        <div class="container text-center">
            <h2 class="heading">DevBlog - A Blog Template Made For Developers</h2>
            <div class="intro">Welcome to my blog. Subscribe and get my latest blog post in your inbox.</div>
            <form class="signup-form form-inline justify-content-center pt-3">
                <div class="form-group">
                    <label class="sr-only" for="semail">Your email</label>
                    <input type="text" id="semail" name="semail1" class="form-control mr-md-1 semail" v-model="searchIt" placeholder="Search">

                    <!-- <input type="email" id="semail" name="semail1" class="form-control mr-md-1 semail" placeholder="Enter email"> -->
                    
                </div>
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div><!--//container-->
    </section>
</template>

<script>
export default {
    name:'Nav',
    // searchPost:'',
    props: [
        // filterSearch =>{ type: Function },
        'searchPost' 
    ],
    
    created() {
        // Use the parent function directly here
        // this.searchMethod();
        // this.$emit('filterSearch');
        this.searchPost;

    },
    computed:{
        searchIt(){
            return this.searchPost;
        
        }
    }
}
</script>