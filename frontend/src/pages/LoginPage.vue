<template>
    <q-page padding>
        <div class="login-container">
            <q-card class="login-card">
                <q-card-section>
                    <div class="text-h6">Login</div>
                </q-card-section>

                <q-card-section>
                    <q-input
                        v-model="email"
                        label="Email"
                        type="email"
                        outlined
                        dense
                        :rules="[rules.required, rules.email]"
                    />
                    <q-input
                        v-model="password"
                        label="Password"
                        type="password"
                        outlined
                        dense
                        :rules="[rules.required]"
                    />
                </q-card-section>

                <q-card-actions class="qa-gutter-sm justify-center">
                    <q-btn
                        label="Entrar"
                        color="primary"
                        @click="handleSignIn"
                    />
                </q-card-actions>
            </q-card>
        </div>
    </q-page>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import AuthenticationService from "../services/AuthenticationService";

const email = ref("");
const password = ref("");

const router = useRouter();
const store  = useStore();

const rules = {
    required: (val: string) => !!val || "Field is required",
    email: (val: string) =>
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val) || "Invalid email",
};

const handleSignIn = async () => {
    if (!email.value || !password.value) {
        alert("Por favor preencha todos os campos.");
        return;
    }

    AuthenticationService.signin(email.value, password.value).then((token) => {
        store.dispatch("updateAccessToken", token);
        router.push("/");
    }).catch((error) => {
        console.error("Sign-in failed:", error);
        alert("Falha no login. Por favor, tente novamente.");
    });
};

const goToRegister = () => {
    router.push("/register");
};
</script>

<style scoped>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.login-card {
    width: 400px;
}
</style>