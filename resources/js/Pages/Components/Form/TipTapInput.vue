<script setup lang="ts">
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import { TextStyle } from '@tiptap/extension-text-style'
import Color from '@tiptap/extension-color'
import Highlight from '@tiptap/extension-highlight'
import Link from '@tiptap/extension-link'
import { Table } from '@tiptap/extension-table'
import TableRow from '@tiptap/extension-table-row'
import TableHeader from '@tiptap/extension-table-header'
import TableCell from '@tiptap/extension-table-cell'
import TextAlign from '@tiptap/extension-text-align'
import FontFamily from '@tiptap/extension-font-family'
import Placeholder from '@tiptap/extension-placeholder'
import { ref, watch } from "vue";
import axios from "axios";
import { Node, mergeAttributes } from '@tiptap/core';
import SvgComponent from "@/Pages/Components/svg-component.vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const fileInput = ref<HTMLInputElement | null>(null);
const loading = ref<boolean>(false);
const props = defineProps<{
    content: string;
}>();
const emits = defineEmits<{
    (e: 'update:content', value: string): void
}>();

const contentData = ref<string>(props.content);

watch(() => contentData.value, (newValue: string) => {
    emits('update:content', newValue);
});

// افزونه سفارشی برای تغییر اندازه تصویر و ویدیو
const ResizableMedia = Node.create({
    name: 'resizableMedia',
    group: 'block',
    draggable: true,
    atom: true,

    addAttributes() {
        return {
            src: { default: null },
            mediaType: { default: 'image' },
            width: { default: '100%' },
        }
    },

    parseHTML() {
        return [
            { tag: 'img[src]', getAttrs: el => ({ src: el.getAttribute('src'), mediaType: 'image', width: el.style.width || '100%' }) },
            { tag: 'video[src]', getAttrs: el => ({ src: el.getAttribute('src'), mediaType: 'video', width: el.style.width || '100%' }) },
        ]
    },

    renderHTML({ HTMLAttributes }) {
        const { mediaType, width, ...attrs } = HTMLAttributes;
        if (mediaType === 'video') {
            return ['div', { style: `width: ${width}; display: inline-block; position: relative;` }, ['video', mergeAttributes(attrs, { controls: true, style: 'width: 100%; border-radius: 8px;' })]];
        }
        return ['div', { style: `width: ${width}; display: inline-block; position: relative;` }, ['img', mergeAttributes(attrs, { style: 'width: 100%; border-radius: 8px;' })]];
    },

    addNodeView() {
        return ({ node, getPos, editor }) => {
            const dom = document.createElement('div');
            dom.style.position = 'relative';
            dom.style.display = 'inline-block';
            dom.style.width = node.attrs.width;
            dom.style.maxWidth = '100%';
            dom.style.margin = '1em 0';
            dom.style.lineHeight = '0';

            let mediaDom;
            if (node.attrs.mediaType === 'video') {
                mediaDom = document.createElement('video');
                mediaDom.controls = true;
            } else {
                mediaDom = document.createElement('img');
            }
            mediaDom.src = node.attrs.src;
            mediaDom.style.width = '100%';
            mediaDom.style.display = 'block';
            mediaDom.style.borderRadius = '8px';
            dom.appendChild(mediaDom);

            // دکمه تغییر اندازه (گوشه پایین سمت چپ مناسب برای سایت راست‌چین)
            const handle = document.createElement('div');
            handle.style.position = 'absolute';
            handle.style.width = '18px';
            handle.style.height = '18px';
            handle.style.backgroundColor = '#2563eb';
            handle.style.bottom = '-9px';
            handle.style.left = '-9px';
            handle.style.cursor = 'sw-resize';
            handle.style.borderRadius = '50%';
            handle.style.border = '2px solid #ffffff';
            handle.style.boxShadow = '0 0 4px rgba(0,0,0,0.4)';
            handle.style.zIndex = '10';
            handle.style.display = 'none';
            dom.appendChild(handle);

            let startX, startWidth;

            const onMouseMove = (e) => {
                const dx = startX - e.clientX;
                let newWidth = startWidth + dx;
                if (newWidth < 100) newWidth = 100;
                dom.style.width = `${newWidth}px`;
            };

            const onMouseUp = () => {
                document.removeEventListener('mousemove', onMouseMove);
                document.removeEventListener('mouseup', onMouseUp);
                if (typeof getPos === 'function') {
                    editor.commands.command(({ tr }) => {
                        tr.setNodeMarkup(getPos(), undefined, {
                            ...node.attrs,
                            width: dom.style.width
                        });
                        return true;
                    });
                }
            };

            handle.addEventListener('mousedown', (e) => {
                e.preventDefault();
                startX = e.clientX;
                startWidth = dom.offsetWidth;
                document.addEventListener('mousemove', onMouseMove);
                document.addEventListener('mouseup', onMouseUp);
            });

            return {
                dom,
                selectNode() {
                    handle.style.display = 'block';
                    mediaDom.style.outline = '3px solid #bfdbfe';
                },
                deselectNode() {
                    handle.style.display = 'none';
                    mediaDom.style.outline = 'none';
                },
                update(newNode) {
                    if (newNode.type !== node.type) return false;
                    node = newNode;
                    dom.style.width = node.attrs.width;
                    mediaDom.src = node.attrs.src;
                    return true;
                }
            };
        };
    }
});

const editor = useEditor({
    content: contentData.value,
    extensions: [
        StarterKit.configure({
            heading: {
                levels: [1, 2, 3, 4, 5, 6],
            },
        }),
        Underline,
        TextStyle,
        Color,
        Highlight.configure({ multicolor: true }),
        Link.configure({ openOnClick: false }),
        ResizableMedia, // افزونه جایگزین تصویر و ویدیو
        Table.configure({ resizable: true }),
        TableRow,
        TableHeader,
        TableCell,
        TextAlign.configure({ types: ['heading', 'paragraph'], alignments: ['left', 'center', 'right', 'justify'] }),
        FontFamily,
        Placeholder.configure({
            placeholder: 'شروع به نوشتن کنید...'
        })
    ],
    editorProps: {
        transformPastedHTML(html) {
            return html
                .replace(/<o:p>.*?<\/o:p>/g, '')
                .replace(/class="Mso[a-zA-Z0-9]+"/g, '')
                .replace(/<!--\[if[^\]]*\]>[\s\S]*?<!\[endif\]-->/gi, '');
        }
    },
    onUpdate: ({ editor }) => {
        const html = editor.getHTML()
        emits('update:content', html)
    },
});

const openFileInput = (accept: string) => {
    if (fileInput.value) {
        fileInput.value.accept = accept;
        fileInput.value.click();
    }
};

const uploadFileToServer = async (fileToUpload: File, type: string): Promise<string | null> => {
    const formData = new FormData();
    formData.append('file', fileToUpload);
    formData.append('type', type);

    try {
        const response = ref<string>('');
        loading.value = true;
        await axios.post(route('admin.courses.addMedia'), formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(res => {
            response.value = res.data.url;
            loading.value = false;
        }).catch(err => {
            loading.value = false;
            console.error(err);
        });

        return response.value;

    } catch (error: any) {
        console.error('خطا در آپلود فایل:', error);
        const errorMessage = error.response?.data?.error || 'آپلود فایل با شکست مواجه شد.';
        alert(errorMessage);
        return null;
    }
};

const handleFileUpload = async (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files?.[0];
    if (!file || !editor.value) {
        return;
    }
    const url = await uploadFileToServer(file, fileInput.value.accept === 'video/*' ? 'video' : 'image');

    if (url) {
        if (fileInput.value.accept === 'image/*') {
            editor.value.chain().focus().insertContent({ type: 'resizableMedia', attrs: { src: url, mediaType: 'image' } }).run();
        } else if (fileInput.value.accept === 'video/*') {
            editor.value.chain().focus().insertContent({ type: 'resizableMedia', attrs: { src: url, mediaType: 'video' } }).run();
        }
    }
    if (target) {
        target.value = '';
    }
};

const pasteFromWordHelp = () => {
    alert('برای افزودن از Word، متن خود را در نرم‌افزار Word کپی کرده و در این ویرایشگر (Ctrl + V) پیست کنید. فرمت‌ها به صورت خودکار شناسایی و اعمال می‌شوند.');
};

const clearFormatting = () => {
    editor.value?.chain().focus().clearNodes().unsetAllMarks().run();
};
</script>

<template>
    <LoadingComponent :loading="loading" />
    <div class="tiptap-container" v-if="editor">
        <input type="file" ref="fileInput" @change="handleFileUpload" style="display: none;" />

        <div class="toolbar">
            <!-- History Group -->
            <div class="button-group">
                <button @click="editor.chain().focus().undo().run()" :disabled="!editor.can().chain().focus().undo().run()" title="بازگردانی (Undo)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7v6h6"></path><path d="M21 17a9 9 0 0 0-9-9 9 9 0 0 0-6 2.3L3 13"></path></svg>
                </button>
                <button @click="editor.chain().focus().redo().run()" :disabled="!editor.can().chain().focus().redo().run()" title="انجام مجدد (Redo)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 7v6h-6"></path><path d="M3 17a9 9 0 0 1 9-9 9 9 0 0 1 6 2.3l3 2.7"></path></svg>
                </button>
            </div>

            <div class="separator"></div>

            <!-- Headings Group -->
            <div class="button-group">
                <button @click="editor.chain().focus().setParagraph().run()" :class="{ active: editor.isActive('paragraph') }" title="پاراگراف (P)" class="text-btn">
                    P
                </button>
                <button @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ active: editor.isActive('heading', { level: 1 }) }" title="تیتر ۱ (H1)" class="text-btn h1-btn">
                    H1
                </button>
                <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ active: editor.isActive('heading', { level: 2 }) }" title="تیتر ۲ (H2)" class="text-btn h2-btn">
                    H2
                </button>
                <button @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ active: editor.isActive('heading', { level: 3 }) }" title="تیتر ۳ (H3)" class="text-btn h3-btn">
                    H3
                </button>
                <button @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ active: editor.isActive('heading', { level: 4 }) }" title="تیتر ۴ (H4)" class="text-btn">
                    H4
                </button>
                <button @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ active: editor.isActive('heading', { level: 5 }) }" title="تیتر ۵ (H5)" class="text-btn">
                    H5
                </button>
                <button @click="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="{ active: editor.isActive('heading', { level: 6 }) }" title="تیتر ۶ (H6)" class="text-btn">
                    H6
                </button>
            </div>

            <div class="separator"></div>

            <!-- Formatting Group -->
            <div class="button-group">
                <button @click="editor.chain().focus().toggleBold().run()" :class="{ active: editor.isActive('bold') }" title="ضخیم (Bold)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path><path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path></svg>
                </button>
                <button @click="editor.chain().focus().toggleItalic().run()" :class="{ active: editor.isActive('italic') }" title="مورب (Italic)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="4" x2="10" y2="4"></line><line x1="14" y1="20" x2="5" y2="20"></line><line x1="15" y1="4" x2="9" y2="20"></line></svg>
                </button>
                <button @click="editor.chain().focus().toggleUnderline().run()" :class="{ active: editor.isActive('underline') }" title="زیرخط (Underline)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3v7a6 6 0 0 0 6 6 6 6 0 0 0 6-6V3"></path><line x1="4" y1="21" x2="20" y2="21"></line></svg>
                </button>
                <button @click="editor.chain().focus().toggleStrike().run()" :class="{ active: editor.isActive('strike') }" title="خط‌خورده (Strike)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.3 19c-1.4 1.4-3.3 2-5.3 2-4 0-7-3-7-7 0-.7.1-1.4.3-2"></path><path d="M14.6 5c1.4-1.4 3.3-2 5.3-2 4 0 7 3 7 7 0 .7-.1 1.4-.3 2"></path><line x1="4" y1="12" x2="20" y2="12"></line></svg>
                </button>
                <button @click="editor.chain().focus().toggleHighlight().run()" :class="{ active: editor.isActive('highlight') }" title="هایلایت (Highlight)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 11-6 6v3h9l3-3"></path><path d="m22 7-4.6 4.6"></path><path d="M15 3.5l2.5 2.5"></path><path d="M9 11 16.5 3.5a2.12 2.12 0 0 1 3 3L12 14"></path></svg>
                </button>
                <button @click="clearFormatting" title="پاک‌سازی فرمت">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3l18 18"></path><path d="M8 8H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2"></path><path d="M12 8v4"></path><path d="M16 8h4"></path></svg>
                </button>
            </div>

            <div class="separator"></div>

            <!-- Alignment Group -->
            <div class="button-group">
                <button @click="editor.chain().focus().setTextAlign('right').run()" :class="{ active: editor.isActive({ textAlign: 'right' }) }" title="راست‌چین">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="21" y1="10" x2="7" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="7" y2="18"></line></svg>
                </button>
                <button @click="editor.chain().focus().setTextAlign('center').run()" :class="{ active: editor.isActive({ textAlign: 'center' }) }" title="وسط‌چین">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="21" y1="6" x2="3" y2="6"></line><line x1="19" y1="12" x2="5" y2="12"></line><line x1="21" y1="18" x2="3" y2="18"></line></svg>
                </button>
                <button @click="editor.chain().focus().setTextAlign('left').run()" :class="{ active: editor.isActive({ textAlign: 'left' }) }" title="چپ‌چین">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="17" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="17" y1="18" x2="3" y2="18"></line></svg>
                </button>
                <button @click="editor.chain().focus().setTextAlign('justify').run()" :class="{ active: editor.isActive({ textAlign: 'justify' }) }" title="تراز کامل (Justify)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="12" x2="3" y2="12"></line><line x1="21" y1="18" x2="3" y2="18"></line></svg>
                </button>
            </div>

            <div class="separator"></div>

            <!-- List Group -->
            <div class="button-group">
                <button @click="editor.chain().focus().toggleBulletList().run()" :class="{ active: editor.isActive('bulletList') }" title="لیست نقطه‌ای">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                </button>
                <button @click="editor.chain().focus().toggleOrderedList().run()" :class="{ active: editor.isActive('orderedList') }" title="لیست عددی">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="10" y1="6" x2="21" y2="6"></line><line x1="10" y1="12" x2="21" y2="12"></line><line x1="10" y1="18" x2="21" y2="18"></line><path d="M4 6h1v4"></path><path d="M4 10h2"></path><path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"></path></svg>
                </button>
            </div>

            <div class="separator"></div>

            <!-- Insert Elements -->
            <div class="button-group">
                <button @click="editor.chain().focus().toggleBlockquote().run()" :class="{ active: editor.isActive('blockquote') }" title="نقل قول (Blockquote)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"></path><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"></path></svg>
                </button>
                <button @click="editor.chain().focus().setHorizontalRule().run()" title="خط افقی (HR)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </button>
                <button @click="openFileInput('image/*')" title="آپلود عکس">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                </button>
                <button @click="openFileInput('video/*')" title="آپلود ویدیو">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                </button>
                <button @click="editor.chain().focus().insertTable({ rows: 3, cols: 3 }).run()" title="افزودن جدول">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line><line x1="9" y1="3" x2="9" y2="21"></line><line x1="15" y1="3" x2="15" y2="21"></line></svg>
                </button>
            </div>

            <div class="separator"></div>

            <!-- Word Tools -->
            <div class="button-group">
                <button @click="pasteFromWordHelp" title="افزودن از Word" class="word-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><path d="M9 12l1 5 1-2.5L12 12l1 2.5L14 17l1-5"></path></svg>
                    <span>از Word</span>
                </button>
            </div>
        </div>

        <EditorContent :editor="editor" class="editor-content" />
    </div>
</template>

<style scoped>
/* Main Container */
.tiptap-container {
    border: 1px solid #d1d5db;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    display: flex;
    flex-direction: column;
    direction: rtl;
}

/* Toolbar */
.toolbar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    border-bottom: 1px solid #e5e7eb;
    background: #f9fafb;
}

.button-group {
    display: flex;
    align-items: center;
    gap: 4px;
    background: #ffffff;
    padding: 4px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 1px 2px rgba(0,0,0,0.02);
}

.separator {
    width: 1px;
    height: 24px;
    background-color: #d1d5db;
    margin: 0 4px;
}

/* Buttons */
.toolbar button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 6px;
    background: transparent;
    color: #4b5563;
    cursor: pointer;
    transition: all 0.2s ease;
}

.toolbar button:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.toolbar button:hover:not(:disabled) {
    background: #f3f4f6;
    color: #111827;
}

.toolbar button.active {
    background: #eff6ff;
    color: #2563eb;
    font-weight: bold;
}

.toolbar button svg {
    width: 18px;
    height: 18px;
}

/* Text Buttons (H1-H6, P) */
.text-btn {
    font-size: 14px;
    font-weight: 600;
    width: auto !important;
    min-width: 36px;
    padding: 0 8px;
    font-family: monospace;
}

.h1-btn { font-size: 16px; font-weight: 800; }
.h2-btn { font-size: 15px; font-weight: 700; }
.h3-btn { font-size: 14px; font-weight: 600; }

/* Word Paste Button */
.word-btn {
    width: auto !important;
    padding: 0 12px !important;
    gap: 6px;
    background: #eff6ff !important;
    color: #1d4ed8 !important;
    border: 1px solid #bfdbfe !important;
}

.word-btn:hover {
    background: #dbeafe !important;
}

.word-btn span {
    font-size: 13px;
    font-weight: 500;
}

/* Editor Area */
.editor-content {
    flex: 1;
    min-height: 400px;
    max-height: 600px;
    overflow-y: auto;
    background: #ffffff;
    padding: 24px 32px;
    cursor: text;
}

/* Tiptap Internal Styles */
.editor-content :deep(.ProseMirror) {
    outline: none;
    font-size: 16px;
    line-height: 1.8;
    color: #374151;
}

.editor-content :deep(.ProseMirror p.is-editor-empty:first-child::before) {
    color: #9ca3af;
    content: attr(data-placeholder);
    float: right;
    height: 0;
    pointer-events: none;
}

/* Typography Inside Editor */
.editor-content :deep(h1) {
    font-size: 2.25em;
    font-weight: 800;
    margin-bottom: 0.5em;
    color: #111827;
}

.editor-content :deep(h2) {
    font-size: 1.8em;
    font-weight: 700;
    margin-top: 1.2em;
    margin-bottom: 0.5em;
    color: #1f2937;
}

.editor-content :deep(h3) {
    font-size: 1.5em;
    font-weight: 600;
    margin-top: 1em;
    margin-bottom: 0.5em;
    color: #374151;
}

.editor-content :deep(h4) {
    font-size: 1.25em;
    font-weight: 600;
    color: #4b5563;
}

.editor-content :deep(h5) {
    font-size: 1.1em;
    font-weight: 600;
    color: #4b5563;
}

.editor-content :deep(h6) {
    font-size: 1em;
    font-weight: 600;
    color: #6b7280;
}

.editor-content :deep(ul),
.editor-content :deep(ol) {
    padding-inline-start: 1.5em;
    margin: 1em 0;
}

.editor-content :deep(blockquote) {
    border-right: 4px solid #cbd5e1;
    border-left: none;
    padding-right: 16px;
    padding-left: 0;
    margin: 1.5em 0;
    font-style: italic;
    color: #475569;
    background: #f8fafc;
    padding-top: 8px;
    padding-bottom: 8px;
    border-radius: 4px;
}

.editor-content :deep(hr) {
    border: none;
    border-top: 2px solid #e2e8f0;
    margin: 2em 0;
}

/* Table Styles */
.editor-content :deep(table) {
    border-collapse: collapse;
    margin: 1.5em 0;
    overflow: hidden;
    table-layout: fixed;
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 0 0 1px #e2e8f0;
}

.editor-content :deep(td),
.editor-content :deep(th) {
    border: 1px solid #cbd5e1;
    box-sizing: border-box;
    min-width: 1em;
    padding: 10px 12px;
    position: relative;
    vertical-align: top;
}

.editor-content :deep(th) {
    background-color: #f1f5f9;
    font-weight: 700;
    text-align: right;
}

.editor-content :deep(.selectedCell:after) {
    background: rgba(200, 200, 255, 0.4);
    content: "";
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    pointer-events: none;
    position: absolute;
    z-index: 2;
}

.editor-content :deep(.column-resize-handle) {
    background-color: #3b82f6;
    bottom: -2px;
    pointer-events: none;
    position: absolute;
    right: -2px;
    top: 0;
    width: 4px;
}
</style>
