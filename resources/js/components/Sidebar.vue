<template>
    <div>
        <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><router-link to="/">Online Exam</router-link> </div>
      <div class="list-group list-group-flush" v-for="exam in exams" :key="exam.id">

        <router-link :to="`/exam_detail/${exam.id}`"  class="list-group-item list-group-item-action bg-light">{{exam.name}}</router-link>
        
      </div>
    </div>
    </div>
</template>
<script>
export default {
    name : 'Sidebar',
    data(){
        return {
            exams : []
        }
    },
     mounted() {
            axios.get('get_all_exams')
            .then((res)=>{
              this.exams = res.data.exams
            });
        },
        
}
</script>