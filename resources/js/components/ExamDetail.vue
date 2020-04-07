<template>
    <div>
        <div class="container-fluid">
        <h1 class="mt-4">Exam Detail Sidebar {{this.$route.params.exam_id}}</h1>
        <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>. The top navbar is optional, and just for demonstration. Just create an element with the <code>#menu-toggle</code> ID which will toggle the menu when clicked.</p>
        <h3>
            {{examDetails}}
        </h3>
      </div>
    </div>
</template>
<script>
export default {
    name : 'ExamDetail',
    data(){
        return {
            exam_details : []
        }
    },
    mounted(){
        
        this.$store.dispatch('examDetails',this.$route.params.exam_id);
    },
    computed : {
        examDetails(){
            this.exam_details = this.$store.getters.examDetails;
            return this.$store.getters.examDetails;
        }
    },
    created(){
        
        
    },
    
}
</script>