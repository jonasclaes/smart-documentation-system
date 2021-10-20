<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <p>I'm an example component.</p>
                        <p>{{ test }}</p>
                        <p>@{{ test }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components: {},
        props: {
            test: String
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
