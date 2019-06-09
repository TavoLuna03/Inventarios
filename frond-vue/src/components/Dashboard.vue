<template>
    <div style="text-align:center">
        <section class="section">
            <div class="container">
                <nav class="navbar" role="navigation" aria-label="main navigation">
                    <div class="navbar-menu">
                        <div class="navbar-item">
                            <router-link to="/" class="navbar-item button is-success is-outlined" >Home</router-link>
                            <router-link to="/categories" class="navbar-item button is-warning is-outlined" >Categories</router-link>
                            <router-link to="/products" class="navbar-item button is-danger is-outlined" >Products</router-link>
                            <router-link to="/purchase" class="navbar-item button is-primary is-outlined" >Purchases</router-link>
                        
                        </div>
                    </div>
                </nav>
                <router-view></router-view>
            </div>
        </section>
    </div>
</template>

