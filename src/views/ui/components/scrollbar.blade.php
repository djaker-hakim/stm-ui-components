
@props([
    
])

<template x-data x-teleport="head">
    <style>
        .side::-webkit-scrollbar {
        width: 5px;
        height: 5px;
        }
        /* Track */
        .side::-webkit-scrollbar-track {
        background: transparent; 
        }
        
        /* Handle */
        .side::-webkit-scrollbar-thumb {
        background: gray ;
        width: 2px;
        height: 2px;
        }
    
        /* Handle on hover */
        .side::-webkit-scrollbar-thumb:hover {
        background: darkgray ;
        /* width: 5px;
        height: 5px; */
        }
    </style>
</template>