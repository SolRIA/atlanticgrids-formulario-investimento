<script setup>
import { ref, watch } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Button } from '@/components/ui/button'
import { Checkbox } from '@/components/ui/checkbox'
import distritos from '@/models/distritos'
import concelhos from '@/models/concelhos'
import beneficiarios from '@/models/beneficiarios'

const passo = ref('contactos')

const distrito = ref(null)
const concelho = ref(null)

const concelhosDistrito = ref(false)

const updateConcelhos = () => {
    console.log(distrito.value)
    concelho.value = null
    concelhosDistrito.value = concelhos.filter(c => c.distrito_id === distrito.value)
}

</script>

<template>

    <Head title="Welcome">

    </Head>
    <div
         class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <header class="not-has-[nav]:hidden mb-6 w-full max-w-[335px] text-sm lg:max-w-4xl">
            <nav class="flex items-center justify-end gap-4">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                      class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                Dashboard
                </Link>
                <template v-else>
                    <Link :href="route('login')"
                          class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]">
                    Log in
                    </Link>
                    <Link :href="route('register')"
                          class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                    Register
                    </Link>
                </template>
            </nav>
        </header>
        <div class="duration-750 starting:opacity-0 flex w-full opacity-100 transition-opacity lg:grow">
            <main class="container">

                <Card>
                    <CardHeader>
                        <CardTitle>ENQUADRAMENTO DO INVESTIMENTO</CardTitle>
                        <CardDescription>Descrição do formulário</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form>
                            <Tabs default-value="contactos" v-model="passo" class="w-full">
                                <TabsList>
                                    <TabsTrigger value="contactos">
                                        Contactos
                                    </TabsTrigger>
                                    <TabsTrigger value="caracterizacao">
                                        Caracterização do Beneficiário
                                    </TabsTrigger>
                                    <TabsTrigger value="projeto">
                                        Projeto/investimento
                                    </TabsTrigger>
                                    <TabsTrigger value="descricao">
                                        Descrição
                                    </TabsTrigger>
                                </TabsList>

                                <TabsContent value="contactos">
                                    <div class="grid items-center w-full gap-4">
                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="name">Nome</Label>
                                            <Input id="name" placeholder="Nome completo" />
                                        </div>
                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="empresa">Empresa/Entidade</Label>
                                            <Input id="empresa" placeholder="Nome da empresa/entidade" />
                                        </div>
                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="telefone">Telefone</Label>
                                            <Input id="telefone" placeholder="Telefone" />
                                        </div>
                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="email">Email</Label>
                                            <Input id="email" placeholder="Email" />
                                        </div>

                                        <Button @click.prevent="passo = 'caracterizacao'">Próximo</Button>
                                    </div>
                                </TabsContent>

                                <TabsContent value="caracterizacao">
                                    <div class="grid items-center w-full gap-4">

                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="name_beneficiario">Nome do Beneficiário</Label>
                                            <Input id="name_beneficiario" placeholder="Nome" />
                                        </div>

                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="nif">Nº de Identificação Fiscal</Label>
                                            <Input id="nif" placeholder="NIF" />
                                        </div>

                                        <div class="flex gap-2">
                                            <div class="flex flex-col space-y-1.5">
                                                <Label for="distrito">Distrito</Label>
                                                <Select autocomplete v-model="distrito"
                                                        @update:model-value="updateConcelhos">
                                                    <SelectTrigger id="distrito">
                                                        <SelectValue placeholder="Escolha o distrito" />
                                                    </SelectTrigger>
                                                    <SelectContent position="popper">
                                                        <SelectItem v-for="d in distritos" :key="d.id" :value="d.id">
                                                            {{ d.nome }}
                                                        </SelectItem>
                                                    </SelectContent>
                                                </Select>
                                            </div>

                                            <div class="flex flex-col space-y-1.5">
                                                <Label for="concelho">Concelho</Label>
                                                <Select v-model="concelho" :disabled="!distrito">
                                                    <SelectTrigger id="concelho">
                                                        <SelectValue placeholder="Escolha o concelho" />
                                                    </SelectTrigger>
                                                    <SelectContent position="popper">
                                                        <SelectItem v-for="c in concelhosDistrito" :key="c.id"
                                                                    :value="c.id">
                                                            {{ c.nome }}
                                                        </SelectItem>
                                                    </SelectContent>
                                                </Select>
                                            </div>
                                        </div>

                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="tipo_beneficiario">Tipo de beneficiário</Label>
                                            <div class="flex gap-1" v-for="b in beneficiarios" :key="b.id">
                                                <Checkbox :id="b.key" />
                                                <label :for="b.key"
                                                       class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                    {{ b.nome }}
                                                </label>
                                            </div>
                                            <div class="flex gap-1">
                                                <Checkbox id="beneficiario_0" />
                                                <label for="beneficiario_0"
                                                       class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                    Outra
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </TabsContent>

                                <TabsContent value="projeto">

                                </TabsContent>

                                <TabsContent value="descricao">

                                </TabsContent>
                            </Tabs>
                        </form>
                    </CardContent>
                    <CardFooter class="flex justify-between flex-row-reverse px-6 pb-6">
                        <Button>Guardar</Button>
                    </CardFooter>
                </Card>

            </main>
        </div>
    </div>
</template>
