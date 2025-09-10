<?php
/*
Template Name: 利用規約 - Tailwind CSS Play CDN対応版
*/

get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-soft': 'pulseSoft 3s infinite',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(40px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        bounceGentle: {
                            '0%, 20%, 50%, 80%, 100%': { transform: 'translateY(0)' },
                            '40%': { transform: 'translateY(-10px)' },
                            '60%': { transform: 'translateY(-5px)' }
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.7' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>

<div class="terms-page-container bg-gradient-to-br from-gray-50 via-red-50 to-orange-50 min-h-screen">
    
    <!-- Hero Section -->
    <section class="hero-section bg-gradient-to-br from-red-900 via-rose-900 to-pink-900 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-10 left-10 w-20 h-20 bg-rose-300/10 rounded-full animate-float"></div>
        <div class="absolute bottom-10 right-10 w-16 h-16 bg-pink-400/10 rounded-full animate-bounce-gentle"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-fade-in">
                <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 border border-white/20">
                    <i class="fas fa-file-contract text-rose-300 text-2xl animate-pulse"></i>
                    <span class="text-lg font-bold tracking-wider">TERMS OF SERVICE</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-rose-300 to-pink-300 bg-clip-text text-transparent">利用</span><br>
                    <span class="bg-gradient-to-r from-white to-red-200 bg-clip-text text-transparent">規約</span>
                </h1>
                <p class="text-xl md:text-2xl text-rose-200 max-w-4xl mx-auto leading-relaxed">
                    当サイトをご利用いただくにあたっての<br class="hidden md:block">
                    規約を定めています。
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 lg:py-20 -mt-16 relative z-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                
                <!-- Terms Content -->
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 animate-slide-up overflow-hidden">
                    
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-red-600 via-rose-600 to-pink-600 p-8 lg:p-12">
                        <div class="text-center text-white">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-gavel text-white text-3xl"></i>
                            </div>
                            <h2 class="text-2xl lg:text-3xl font-black mb-4">利用規約</h2>
                            <p class="text-rose-100 text-lg">サービス利用における重要な規約事項</p>
                        </div>
                    </div>
                    
                    <!-- Content Body -->
                    <div class="p-8 lg:p-12">
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-12">
                            
                            <!-- Article 1 -->
                            <div class="border-l-4 border-red-500 pl-8 relative">
                                <div class="absolute -left-3 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">1</span>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <i class="fas fa-check-circle text-red-500 mr-3"></i>
                                    第1条（適用）
                                </h3>
                                <div class="bg-red-50 rounded-2xl p-6 border border-red-200">
                                    <p class="mb-4">
                                        本規約は、<strong class="text-red-700">助成金インサイト</strong>（以下「当サイト」といいます）の提供するサービス（以下「本サービス」といいます）の利用に関する一切に適用されるものとします。
                                    </p>
                                    <p>
                                        利用者は、本サービスを利用することにより、<strong class="text-red-700">本規約の全ての記載内容に同意したものとみなされます。</strong>
                                    </p>