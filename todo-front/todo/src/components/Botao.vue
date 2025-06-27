<script lang="ts">
export default {
    props: {
        texto: { type: String, required: true },
    }
}
</script>

<template>
    <button class="botao" type="button">
        {{ texto }}
    </button>
</template>

<style scoped>
.botao {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 2rem;
    color: var(--creme, #FFFAF3);
    background-color:  #F22B02;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
}

.botao:hover {
    background-color: #ca2302;
}
</style>