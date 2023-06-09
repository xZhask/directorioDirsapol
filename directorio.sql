PGDMP     	    2                {         
   directorio    15.2    15.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    24612 
   directorio    DATABASE     }   CREATE DATABASE directorio WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE directorio;
                postgres    false            �            1259    24623    contacto    TABLE     �   CREATE TABLE public.contacto (
    "idContacto" integer NOT NULL,
    nombre text NOT NULL,
    grado text NOT NULL,
    telefono text NOT NULL,
    tipo "char" NOT NULL,
    "idIpress" integer NOT NULL
);
    DROP TABLE public.contacto;
       public         heap    postgres    false            �            1259    24622    contacto_idContacto_seq    SEQUENCE     �   CREATE SEQUENCE public."contacto_idContacto_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public."contacto_idContacto_seq";
       public          postgres    false    217            	           0    0    contacto_idContacto_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public."contacto_idContacto_seq" OWNED BY public.contacto."idContacto";
          public          postgres    false    216            �            1259    24614    ipress    TABLE     �   CREATE TABLE public.ipress (
    "idIpress" smallint NOT NULL,
    "nombreIpress" text NOT NULL,
    "emailEstadistica" text,
    "emailIpress" text,
    clave text
);
    DROP TABLE public.ipress;
       public         heap    postgres    false            �            1259    24613    ipress_idIpress_seq    SEQUENCE     �   CREATE SEQUENCE public."ipress_idIpress_seq"
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public."ipress_idIpress_seq";
       public          postgres    false    215            
           0    0    ipress_idIpress_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public."ipress_idIpress_seq" OWNED BY public.ipress."idIpress";
          public          postgres    false    214            k           2604    24626    contacto idContacto    DEFAULT     ~   ALTER TABLE ONLY public.contacto ALTER COLUMN "idContacto" SET DEFAULT nextval('public."contacto_idContacto_seq"'::regclass);
 D   ALTER TABLE public.contacto ALTER COLUMN "idContacto" DROP DEFAULT;
       public          postgres    false    216    217    217            j           2604    24617    ipress idIpress    DEFAULT     v   ALTER TABLE ONLY public.ipress ALTER COLUMN "idIpress" SET DEFAULT nextval('public."ipress_idIpress_seq"'::regclass);
 @   ALTER TABLE public.ipress ALTER COLUMN "idIpress" DROP DEFAULT;
       public          postgres    false    215    214    215                      0    24623    contacto 
   TABLE DATA           [   COPY public.contacto ("idContacto", nombre, grado, telefono, tipo, "idIpress") FROM stdin;
    public          postgres    false    217   �                  0    24614    ipress 
   TABLE DATA           f   COPY public.ipress ("idIpress", "nombreIpress", "emailEstadistica", "emailIpress", clave) FROM stdin;
    public          postgres    false    215   �                  0    0    contacto_idContacto_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public."contacto_idContacto_seq"', 1, false);
          public          postgres    false    216                       0    0    ipress_idIpress_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public."ipress_idIpress_seq"', 81, true);
          public          postgres    false    214            o           2606    24630    contacto contacto_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.contacto
    ADD CONSTRAINT contacto_pkey PRIMARY KEY ("idContacto");
 @   ALTER TABLE ONLY public.contacto DROP CONSTRAINT contacto_pkey;
       public            postgres    false    217            m           2606    24621    ipress ipress_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.ipress
    ADD CONSTRAINT ipress_pkey PRIMARY KEY ("idIpress");
 <   ALTER TABLE ONLY public.ipress DROP CONSTRAINT ipress_pkey;
       public            postgres    false    215            p           2606    24631    contacto ipressContacto    FK CONSTRAINT     �   ALTER TABLE ONLY public.contacto
    ADD CONSTRAINT "ipressContacto" FOREIGN KEY ("idIpress") REFERENCES public.ipress("idIpress") ON UPDATE CASCADE ON DELETE CASCADE;
 C   ALTER TABLE ONLY public.contacto DROP CONSTRAINT "ipressContacto";
       public          postgres    false    3181    217    215                  x������ � �          ]  x��YM��F=��BE�jA�c3���F3�H��Sl'N*�C6�����ߴ,=�#1�WEQ�����uk1il�QR�R	J��P��-U�&�Mx=.�}|*���}��%W��g��w�������<�5�/�����|��!�^������i'^��ަVF	;��T�L)0�}�#~5�H-%�E1M���脰��l�������gu?>�%#�@(.����/���*�^���B2���k).%�t5&כҔKjr�2����v���o�j =�x�`��` ��mձU'+eE�c�C�St�{/�ΆT��}�;ѐ����Fv�yB�Ix���<-)��9'	�����t��c:�=���1"��<��������X�$��(�1�w��� �BZƺ���!�rt�� H�`�\c�P��2�B�jJ�5��9cb�m��bR��OM�0�$OL�&·��Սg���
b��@��0>��b}�0n'>Gi�S���d<H��X���
�\�E�%Ke�vQW���t���2�)�4����Xӣ2�يm:��G�Ync b}��ON��2hm�r��q�f��;B�\�H��8��L��LK�Q51/�LcK��-3:'^a��I���!��"���D��x�t�~�T֜HK�wQ�B�D�}�27��0�߳��@dwW^��ׯ����v��FhPwf12���$� ���@BŁ6�l}�W%y�v�B�f��-Ɠ�brb���*�:bH\����A{�&f�~Is�C0#�P�w�I�X���-i6�km�䷧HaU1�M/��&�����V�TTc�ky���P�8_�Q*cA	�B��JV�?�E�}W���@���%Y���A&f��%��t�Ul�+S�F�����n��GU��JegJ��ahn牖�W4���6����SD�0��z�k������chA�9O�t.�L�"��ş�@�=�"����e��U����A��a�^�����!Ж]�N���H�X�_��+�jW�#򚒮��������P�b)�Q��piI�^+���v 5�`
a<�k{���D�qGSe���6���?M���[��ZG4q����p��������t�     