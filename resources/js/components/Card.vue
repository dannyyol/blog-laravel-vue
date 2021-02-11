<template>
    <section class="blog-list px-3 py-5 p-md-5">
        <!-- <post-container></post-container> -->
        
        <div class="container">
            <slot name="top"></slot>

            <slot name="next"></slot>
            
        </div>
    </section>
    
</template>

<script>
    export default {
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
