import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface Contacto {
    nome: string,
    empresa: string,
    telefone: string,
    email: string
}

export interface Caracterizacao {
    nome: string,
    nif: string,
    distrito: number | null,
    concelho: number | null,
    localidade: string,
    tipo: string,
    empresa_mais_dois_anos: boolean,
    grande_empresa: boolean,
    sector: string,
    cae: string
}

export interface Projeto {
    designacao: string,
    distrito: string,
    concelho: string,
    freguesia: Freguesia | null,
    tipologia: number,
    custo: number
}

export interface SelectType {
    id: number;
    nome: string
}

export interface Distrito {
    id: number;
    nome: string
}

export interface Concelho {
    id: number;
    distrito_id: number;
    nome: string
}

export interface Freguesia {
    id: number;
    concelho_id: number;
    nome: string
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;
