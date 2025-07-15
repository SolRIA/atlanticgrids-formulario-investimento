<script setup lang="ts">
import { ref, watch, onMounted } from 'vue'
import { Head, Link, usePage } from '@inertiajs/vue3'
import { debounce } from 'lodash'
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
import {
    ComboboxInput,
    ComboboxItem,
    Combobox,
    ComboboxAnchor,
    ComboboxTrigger,
    ComboboxList
} from '@/components/ui/combobox'
import { ComboboxViewport, ComboboxVirtualizer } from 'reka-ui'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Button } from '@/components/ui/button'
import { Checkbox } from '@/components/ui/checkbox'
import { Textarea } from '@/components/ui/textarea'
import Icon from '@/components/Icon.vue'
import { type Freguesia, type Concelho, type SharedData, type User, type Distrito, type SelectType, type Contacto, type Caracterizacao, type Projeto } from '@/types'

const passo = ref('contactos')

const page = usePage<SharedData>()
const user = page.props.auth.user as User

const formularioConcluido = ref(false)

const filtroFreguesias = ref('')

let distritos: Distrito[] = []
const concelhos = ref<Concelho[]>([])
const freguesias = ref<Freguesia[]>([])
const beneficiarios = ref<SelectType[]>([])
const tipologias = ref<SelectType[]>([])

onMounted(async () => {
    await fetchDistritos()
    await fetchBeneficiarios()
    await fetchTipologias()
})

watch(filtroFreguesias, debounce(async () => {
    await fetchFreguesias(filtroFreguesias.value)
}, 500))

const contactos = ref<Contacto>({
    nome: '',
    empresa: '',
    telefone: '',
    email: ''
})
const caracterizacao = ref<Caracterizacao>({
    nome: '',
    nif: '',
    distrito: null,
    concelho: null,
    localidade: '',
    tipo: '',
    empresa_mais_dois_anos: false,
    grande_empresa: false,
    sector: '',
    cae: ''
})
const projeto = ref<Projeto>({
    designacao: '',
    distrito: '',
    concelho: '',
    freguesia: null,
    tipologia: 0,
    custo: 0
})
const descricao = ref('')

const updateConcelhos = async () => {

    caracterizacao.value.concelho = null

    if (caracterizacao.value.distrito === null) return

    await fetchConcelhos()
}

const alteraTab = (nome: string) => {
    passo.value = nome
}

const fetchBeneficiarios = async () => {
    const response = await fetch('beneficiarios')

    if (response.ok === false) {
        console.log('Beneficiarios')
        return
    }

    beneficiarios.value = await response.json()
}

const fetchTipologias = async () => {
    const response = await fetch('tipologias')

    if (response.ok === false) {
        console.log('Tipologias')
        return
    }

    tipologias.value = await response.json()
}

const fetchDistritos = async () => {
    const response = await fetch('distritos',
        {
            method: 'GET',
            headers: {
                'content-type': 'application/json;charset=UTF-8',
            }
        })

    if (response.ok === false) {
        console.log('Distritos')
        return
    }

    distritos = await response.json()
}

const fetchConcelhos = async () => {
    if (caracterizacao.value.distrito === null) return

    const response = await fetch(`/concelhos?d=${caracterizacao.value.distrito}`)

    if (response.ok === false) {
        console.log('Concelhos')
        return
    }

    concelhos.value = await response.json()
}

const fetchFreguesias = async (nome: string) => {
    freguesias.value = []
    if (nome === null) return

    const response = await fetch(`/freguesias?n=${nome}`)

    if (response.ok === false) {
        console.log('Freguesias')
        return
    }

    freguesias.value = await response.json()
}

</script>

<template>

    <Head title="Formulário">

    </Head>
    <div
         class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <header class="container not-has-[nav]:hidden mb-6 w-full text-sm">
            <nav class="flex items-center justify-end gap-4">
                <Link v-if="user" :href="route('dashboard')"
                      class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                Dashboard
                </Link>
                <template v-else>
                    <Link :href="route('login')"
                          class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]">
                    Entrar
                    </Link>
                    <Link :href="route('register')"
                          class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                    Registrar
                    </Link>
                </template>
            </nav>
        </header>
        <div class="flex w-full justify-center lg:grow">
            <main class="container">

                <div class="flex justify-between m-2">
                    <img src="/pt2030_cofinanciamento.png" alt="cofinanciado pt2030" class="h-12" />
                    <a href="https://www.atlanticgrids.pt" target="_blank">
                        <div class="flex flex-col justify-items-center">
                            <img src="/logo-sm.svg" alt="atlantic grids" class="h-14" />
                            <div>Atlantic Grids</div>
                        </div>
                    </a>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>ENQUADRAMENTO DO INVESTIMENTO</CardTitle>
                        <CardDescription>Descrição do formulário</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form>
                            <Tabs default-value="contactos" v-model="passo" class="w-full">
                                <TabsList class="grid w-full grid-cols-4 h-12">
                                    <TabsTrigger value="contactos" class="text-lg">
                                        Contactos
                                    </TabsTrigger>
                                    <TabsTrigger value="caracterizacao" class="text-lg">
                                        Caracterização do Beneficiário
                                    </TabsTrigger>
                                    <TabsTrigger value="projeto" class="text-lg">
                                        Projeto/investimento
                                    </TabsTrigger>
                                    <TabsTrigger value="descricao" class="text-lg">
                                        Descrição
                                    </TabsTrigger>
                                </TabsList>

                                <TabsContent value="contactos">
                                    <div class="grid items-center w-full gap-4">
                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="name">Nome *</Label>
                                            <Input id="name" v-model="contactos.nome" placeholder="Nome completo" />
                                        </div>
                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="empresa">Empresa/Entidade</Label>
                                            <Input id="empresa" v-model="contactos.empresa"
                                                   placeholder="Nome da empresa/entidade" />
                                        </div>
                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="telefone">Telefone</Label>
                                            <Input id="telefone" v-model="contactos.telefone" placeholder="Telefone" />
                                        </div>
                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="email">Email *</Label>
                                            <Input id="email" v-model="contactos.email" placeholder="Email"
                                                   type="email" />
                                        </div>

                                        <Button @click.prevent="alteraTab('caracterizacao')" class="justify-self-end">
                                            Próximo
                                        </Button>
                                    </div>
                                </TabsContent>

                                <TabsContent value="caracterizacao">
                                    <div class="grid items-center w-full gap-4">

                                        <div class="columns-1 md:columns-2">

                                            <div class="flex flex-col space-y-1.5">
                                                <Label for="name_beneficiario" class="text-lg">
                                                    Nome do Beneficiário
                                                </Label>
                                                <Input id="name_beneficiario" v-model="caracterizacao.nome"
                                                       placeholder="Nome" />
                                            </div>

                                            <div class="flex flex-col space-y-1.5">
                                                <Label for="nif" class="text-lg">Nº de Identificação Fiscal</Label>
                                                <Input id="nif" v-model="caracterizacao.nif" placeholder="NIF" />
                                            </div>
                                        </div>

                                        <div class="flex gap-2">
                                            <div class="flex flex-col space-y-1.5">
                                                <Label for="distrito" class="text-lg">Distrito</Label>
                                                <Select v-model="caracterizacao.distrito"
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
                                                <Label for="concelho" class="text-lg">Concelho</Label>
                                                <Select v-model="caracterizacao.concelho"
                                                        :disabled="!caracterizacao.distrito">
                                                    <SelectTrigger id="concelho">
                                                        <SelectValue placeholder="Escolha o concelho" />
                                                    </SelectTrigger>
                                                    <SelectContent position="popper">
                                                        <SelectItem v-for="c in concelhos" :key="c.id" :value="c.id">
                                                            {{ c.nome }}
                                                        </SelectItem>
                                                    </SelectContent>
                                                </Select>
                                            </div>
                                        </div>

                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="tipo_beneficiario" class="text-lg">
                                                Tipo de beneficiário *
                                            </Label>
                                            <Select id="tipo_beneficiario" v-model="caracterizacao.tipo">
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Escolha o tipo de beneficiário" />
                                                </SelectTrigger>
                                                <SelectContent position="popper">
                                                    <SelectItem v-for="b in beneficiarios" :key="b.id" :value="b.id">
                                                        {{ b.nome }}
                                                    </SelectItem>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        <div class="flex flex-col space-y-3.5">
                                            <Label class="text-lg">
                                                No caso de se tratar de uma empresa: (caracterização se possível)
                                            </Label>
                                            <div class="flex gap-2">
                                                <Checkbox id="caracterizacao_empresa_mais_dois_anos"
                                                          v-model="caracterizacao.empresa_mais_dois_anos" />
                                                <label for="caracterizacao_empresa_mais_dois_anos"
                                                       class="text-md font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                    Empresa com mais de dois anos *
                                                </label>
                                            </div>

                                            <div class="flex gap-2">
                                                <Checkbox id="caracterizacao_grande_empresa"
                                                          v-model="caracterizacao.grande_empresa" />
                                                <label for="caracterizacao_grande_empresa"
                                                       class="text-md font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                    Grande empresa
                                                </label>
                                            </div>
                                        </div>

                                        <div class="columns-1 md:columns-2">
                                            <div class="flex flex-col space-y-1.5">
                                                <Label for="sector_atividade" class="text-lg">
                                                    Setor de atividade *
                                                </Label>
                                                <Input id="sector_atividade" v-model="caracterizacao.sector"
                                                       placeholder="Setor de atividade" />
                                            </div>

                                            <div class="flex flex-col space-y-1.5">
                                                <Label for="cae" class="text-lg">CAE</Label>
                                                <Input id="cae" v-model="caracterizacao.cae" placeholder="CAE" />
                                            </div>
                                        </div>

                                        <div class="justify-self-end flex gap-2">
                                            <Button @click.prevent="alteraTab('contactos')">
                                                Anterior
                                            </Button>
                                            <Button @click.prevent="alteraTab('projeto')">
                                                Próximo
                                            </Button>
                                        </div>
                                    </div>
                                </TabsContent>

                                <TabsContent value="projeto">
                                    <div class="grid items-center w-full gap-4">
                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="designacao_operacao" class="text-lg">
                                                Designação da operação
                                            </Label>
                                            <Input id="designacao_operacao" v-model="projeto.designacao"
                                                   placeholder="Designação da operação" />
                                        </div>

                                        <Label class="text-lg">
                                            Freguesia e Concelho onde vai realizar o investimento (incluir planta de
                                            localização - se possível) *:
                                        </Label>


                                        <div class="flex flex-col space-y-1.5 w-full">
                                            <Label for="projeto_freguesia" class="text-lg">Freguesia</Label>

                                            <Combobox id="projeto_freguesia" v-model="projeto.freguesia" class="w-full">
                                                <ComboboxAnchor as-child>
                                                    <ComboboxTrigger as-child>
                                                        <Button variant="outline" class="justify-between w-full">
                                                            {{ projeto?.freguesia?.nome ?? 'Escolha uma freguesia' }}

                                                            <Icon name="ChevronsUpDown"
                                                                  class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                                                        </Button>
                                                    </ComboboxTrigger>
                                                </ComboboxAnchor>

                                                <ComboboxList class="h-80 overflow-y-auto w-[850px]">
                                                    <ComboboxInput v-model="filtroFreguesias" />

                                                    <ComboboxViewport>
                                                        <ComboboxVirtualizer v-slot="{ option }" :options="freguesias"
                                                                             :text-content="(x) => x.nome"
                                                                             :estimate-size="35">
                                                            <ComboboxItem :value="option" class="w-[850px]">
                                                                {{ option.nome }}
                                                            </ComboboxItem>
                                                        </ComboboxVirtualizer>
                                                    </ComboboxViewport>

                                                </ComboboxList>
                                            </Combobox>
                                        </div>

                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="tipo_beneficiario" class="text-lg">
                                                Tipologias de investimento *
                                            </Label>
                                            <Select id="tipo_beneficiario" v-model="projeto.tipologia">
                                                <SelectTrigger>
                                                    <SelectValue placeholder="Escolha a tipologia de investimento" />
                                                </SelectTrigger>
                                                <SelectContent position="popper">
                                                    <SelectItem v-for="t in tipologias" :key="t.id" :value="t.id">
                                                        {{ t.nome }}
                                                    </SelectItem>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="custo_operacao" class="text-lg">
                                                Custo total previsto
                                            </Label>
                                            <Input id="custo_operacao" v-model="projeto.custo" placeholder="Custo"
                                                   type="number" />
                                        </div>

                                        <div class="justify-self-end flex gap-2">
                                            <Button @click.prevent="alteraTab('caracterizacao')">
                                                Anterior
                                            </Button>
                                            <Button @click.prevent="alteraTab('descricao')">
                                                Próximo
                                            </Button>
                                        </div>
                                    </div>
                                </TabsContent>

                                <TabsContent value="descricao">
                                    <div class="grid items-center w-full gap-4">

                                        <div class="flex flex-col space-y-1.5">
                                            <Label for="descricao" class="text-lg">
                                                Breve descrição do investimento/operação e questão que pretende
                                                esclarecer? *
                                            </Label>
                                            <Textarea id="descricao" v-model="descricao" placeholder="Descrição" />
                                        </div>

                                        <Button @click.prevent="alteraTab('projeto')" class="justify-self-end">
                                            Anterior
                                        </Button>
                                    </div>
                                </TabsContent>
                            </Tabs>
                        </form>
                    </CardContent>
                    <CardFooter class="flex justify-between flex-row-reverse px-6 pb-6">
                        <Button :disabled="formularioConcluido === false">Guardar</Button>
                    </CardFooter>
                </Card>

            </main>
        </div>
    </div>
</template>
