<script setup lang="ts">
import {useEditor, EditorContent} from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import {TextStyle} from '@tiptap/extension-text-style'
import Color from '@tiptap/extension-color'
import Highlight from '@tiptap/extension-highlight'
import Link from '@tiptap/extension-link'
import Image from '@tiptap/extension-image'
import {Table} from '@tiptap/extension-table'
import TableRow from '@tiptap/extension-table-row'
import TableHeader from '@tiptap/extension-table-header'
import TableCell from '@tiptap/extension-table-cell'
import TextAlign from '@tiptap/extension-text-align'
import FontFamily from '@tiptap/extension-font-family'
import Placeholder from '@tiptap/extension-placeholder'
import {Video} from '../Helper/Video'
import {ref, watch} from "vue";
import axios from "axios";
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
watch(() => contentData.value,
    (newValue: string) => {
        console.log(newValue);
        emits('update:content', newValue);
    });
const editor = useEditor({
    content: contentData,
    extensions: [
        StarterKit,
        Underline,
        TextStyle,
        Color,
        Highlight.configure({multicolor: true}),
        Link.configure({openOnClick: false}),
        Image,
        Video,
        Table.configure({resizable: true}),
        TableRow,
        TableHeader,
        TableCell,
        TextAlign.configure({types: ['heading', 'paragraph']}),
        FontFamily,
        Placeholder.configure({
            placeholder: 'شروع به نوشتن کنید...'
        })
    ],
    onUpdate: ({editor}) => {
        const html = editor.getHTML()
        emits('update:content', html)
    },
})

const openFileInput = (accept: string) => {
    if (fileInput.value) {
        fileInput.value.accept = accept;
        fileInput.value.click();
    }
};


// تابع برای آپلود فایل به سرور لاراول
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
        });

        // URL برگشتی از سرور را برمی‌گردانیم
        return response.value;

    } catch (error: any) {
        console.error('خطا در آپلود فایل:', error);
        const errorMessage = error.response?.data?.error || 'آپلود فایل با شکست مواجه شد.';
        alert(errorMessage);
        return null;
    }
};

// تابع برای مدیریت فایل انتخاب شده
const handleFileUpload = async (event: Event) => {
    const target = event.target as HTMLInputElement;
    const file = target.files?.[0];
    if (!file || !editor.value) {
        return;
    }
    const url = await uploadFileToServer(file, fileInput.value.accept === 'video/*' ? 'video' : 'image');

    if (url) {
        if (fileInput.value.accept === 'image/*') {
            editor.value.chain().focus().setImage({src: url}).run();
        } else if (fileInput.value.accept === 'video/*') {
            editor.value.chain().focus().setVideo({src: url}).run();
        }
    }
    if (target) {
        target.value = '';
    }
};

</script>

<template>
    <LoadingComponent :loading="loading"/>
    <div class="tiptap-container">
        <input
            type="file"
            ref="fileInput"
            @change="handleFileUpload"
            style="display: none;"
        />
        <div class="toolbar" v-if="editor">
            <!-- Formatting Group -->
            <div class="button-group">
                <button @click="editor.chain().focus().toggleBold().run()"
                        :class="{ active: editor.isActive('bold') }"
                        title="Bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
                        <path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path>
                    </svg>
                </button>
                <button @click="editor.chain().focus().toggleItalic().run()"
                        :class="{ active: editor.isActive('italic') }"
                        title="Italic">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="4" x2="10" y2="4"></line>
                        <line x1="14" y1="20" x2="5" y2="20"></line>
                        <line x1="15" y1="4" x2="9" y2="20"></line>
                    </svg>
                </button>
                <button @click="editor.chain().focus().toggleUnderline().run()"
                        :class="{ active: editor.isActive('underline') }"
                        title="Underline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 3v7a6 6 0 0 0 6 6 6 6 0 0 0 6-6V3"></path>
                        <line x1="4" y1="21" x2="20" y2="21"></line>
                    </svg>
                </button>
                <button @click="editor.chain().focus().toggleStrike().run()"
                        :class="{ active: editor.isActive('strike') }"
                        title="Strike">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.3 19c-1.4 1.4-3.3 2-5.3 2-4 0-7-3-7-7 0-.7.1-1.4.3-2"></path>
                        <path d="M14.6 5c1.4-1.4 3.3-2 5.3-2 4 0 7 3 7 7 0 .7-.1 1.4-.3 2"></path>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                    </svg>
                </button>
                <button @click="editor.chain().focus().toggleHighlight().run()"
                        :class="{ active: editor.isActive('highlight') }"
                        title="Highlight">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 11-6 6v3h9l3-3"></path>
                        <path d="m22 7-4.6 4.6"></path>
                        <path d="M15 3.5l2.5 2.5"></path>
                        <path d="M9 11 16.5 3.5a2.12 2.12 0 0 1 3 3L12 14"></path>
                    </svg>
                </button>
            </div>

            <div class="separator"></div>

            <!-- Alignment Group -->
            <div class="button-group">
                <button @click="editor.chain().focus().setTextAlign('left').run()"
                        :class="{ active: editor.isActive({ textAlign: 'left' }) }"
                        title="Align Left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="17" y1="10" x2="3" y2="10"></line>
                        <line x1="21" y1="6" x2="3" y2="6"></line>
                        <line x1="21" y1="14" x2="3" y2="14"></line>
                        <line x1="17" y1="18" x2="3" y2="18"></line>
                    </svg>
                </button>
                <button @click="editor.chain().focus().setTextAlign('center').run()"
                        :class="{ active: editor.isActive({ textAlign: 'center' }) }"
                        title="Align Center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="21" y1="6" x2="3" y2="6"></line>
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <line x1="21" y1="18" x2="3" y2="18"></line>
                    </svg>
                </button>
                <button @click="editor.chain().focus().setTextAlign('right').run()"
                        :class="{ active: editor.isActive({ textAlign: 'right' }) }"
                        title="Align Right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="21" y1="10" x2="7" y2="10"></line>
                        <line x1="21" y1="6" x2="3" y2="6"></line>
                        <line x1="21" y1="14" x2="3" y2="14"></line>
                        <line x1="21" y1="18" x2="7" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div class="separator"></div>

            <!-- List Group -->
            <div class="button-group">
                <button @click="editor.chain().focus().toggleBulletList().run()"
                        :class="{ active: editor.isActive('bulletList') }"
                        title="Bullet List">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                </button>
                <button @click="editor.chain().focus().toggleOrderedList().run()"
                        :class="{ active: editor.isActive('orderedList') }"
                        title="Ordered List">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="10" y1="6" x2="21" y2="6"></line>
                        <line x1="10" y1="12" x2="21" y2="12"></line>
                        <line x1="10" y1="18" x2="21" y2="18"></line>
                        <path d="M4 6h1v4"></path>
                        <path d="M4 10h2"></path>
                        <path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"></path>
                    </svg>
                </button>
            </div>

            <div class="separator"></div>
            <div class="flex items-center gap-5">
                <!-- دکمه آپلود عکس -->
                <SvgComponent name="picture" class="size-5 cursor-pointer" @click="openFileInput('image/*')"
                              title="آپلود عکس"/>
                <!-- دکمه آپلود ویدیو -->
                <SvgComponent name="video" class="size-5 cursor-pointer" @click="openFileInput('video/*')"
                              title="آپلود ویدیو"/>
            </div>
            <div class="separator"></div>

            <!-- Insert Group -->
            <div class="button-group">
                <button @click="editor.chain().focus().insertTable({ rows: 3, cols: 3 }).run()" title="Insert Table">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="3" y1="9" x2="21" y2="9"></line>
                        <line x1="3" y1="15" x2="21" y2="15"></line>
                        <line x1="9" y1="3" x2="9" y2="21"></line>
                        <line x1="15" y1="3" x2="15" y2="21"></line>
                    </svg>
                </button>
            </div>
        </div>

        <EditorContent :editor="editor" class="editor-content"/>
    </div>
</template>

<style scoped>
/* Main Container */
.tiptap-container {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    overflow: hidden;
    font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    display: flex;
    flex-direction: column;
}

/* Toolbar */
.toolbar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    border-bottom: 1px solid #e2e8f0;
    background: #f8fafc;
}

.button-group {
    display: flex;
    gap: 4px;
}

.separator {
    width: 1px;
    height: 24px;
    background-color: #cbd5e1;
    margin: 0 8px;
}

/* Buttons */
.toolbar button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 6px;
    background: transparent;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
}

.toolbar button:hover {
    background: #e2e8f0;
    color: #1e293b;
}

.toolbar button.active {
    background: #2563eb;
    color: #ffffff;
}

.toolbar button svg {
    width: 18px;
    height: 18px;
}

/* Editor Area */
.editor-content {
    flex: 1;
    min-height: 300px;
    background: #ffffff;
    padding: 24px 32px;
    cursor: text;
}

/* Tiptap Internal Styles (Prose Mirror) */
.editor-content :deep(.ProseMirror) {
    outline: none;
    font-size: 16px;
    line-height: 1.75;
    color: #334155;
}

.editor-content :deep(.ProseMirror p.is-editor-empty:first-child::before) {
    color: #94a3b8;
    content: attr(data-placeholder);
    float: right; /* Adjusted for RTL support if needed, otherwise 'left' */
    height: 0;
    pointer-events: none;
}

/* Typography Inside Editor */
.editor-content :deep(h1) {
    font-size: 2em;
    font-weight: 800;
    margin-bottom: 0.5em;
    color: #0f172a;
}

.editor-content :deep(h2) {
    font-size: 1.5em;
    font-weight: 700;
    margin-top: 1em;
    margin-bottom: 0.5em;
    color: #1e293b;
}

.editor-content :deep(h3) {
    font-size: 1.25em;
    font-weight: 600;
    margin-top: 1em;
    margin-bottom: 0.5em;
    color: #334155;
}

.editor-content :deep(ul),
.editor-content :deep(ol) {
    padding-inline-start: 1.5em;
    margin: 1em 0;
}

.editor-content :deep(blockquote) {
    border-left: 4px solid #cbd5e1;
    padding-left: 16px;
    margin: 1.5em 0;
    font-style: italic;
    color: #475569;
}

.editor-content :deep(pre) {
    background: #1e293b;
    color: #f8fafc;
    padding: 12px;
    border-radius: 8px;
    font-family: 'Courier New', Courier, monospace;
    overflow-x: auto;
}

.editor-content :deep(code) {
    background: #f1f5f9;
    padding: 2px 4px;
    border-radius: 4px;
    font-family: monospace;
    font-size: 0.9em;
    color: #ef4444;
}

.editor-content :deep(mark) {
    background-color: #fef08a;
    padding: 0 2px;
    border-radius: 2px;
}

/* Table Styles */
.editor-content :deep(table) {
    border-collapse: collapse;
    margin: 0;
    overflow: hidden;
    table-layout: fixed;
    width: 100%;
}

.editor-content :deep(td),
.editor-content :deep(th) {
    border: 1px solid #cbd5e1;
    box-sizing: border-box;
    min-width: 1em;
    padding: 6px 8px;
    position: relative;
    vertical-align: top;
}

.editor-content :deep(th) {
    background-color: #f1f5f9;
    font-weight: bold;
    text-align: left;
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
    background-color: #adf;
    bottom: -2px;
    pointer-events: none;
    position: absolute;
    right: -2px;
    top: 0;
    width: 4px;
}
</style>
