<script setup lang="ts">
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import TextStyle from '@tiptap/extension-text-style'
import Color from '@tiptap/extension-color'
import Highlight from '@tiptap/extension-highlight'
import Link from '@tiptap/extension-link'
import Image from '@tiptap/extension-image'
import Table from '@tiptap/extension-table'
import TableRow from '@tiptap/extension-table-row'
import TableHeader from '@tiptap/extension-table-header'
import TableCell from '@tiptap/extension-table-cell'
import TextAlign from '@tiptap/extension-text-align'
import FontFamily from '@tiptap/extension-font-family'
import Placeholder from '@tiptap/extension-placeholder'

const editor = useEditor({
    content: '',
    extensions: [
        StarterKit,
        Underline,
        TextStyle,
        Color,
        Highlight,
        Link.configure({ openOnClick: false }),
        Image,
        Table.configure({ resizable: true }),
        TableRow,
        TableHeader,
        TableCell,
        TextAlign.configure({ types: ['heading', 'paragraph'] }),
        FontFamily,
        Placeholder.configure({
            placeholder: 'شروع به نوشتن کنید...'
        })
    ]
})
</script>

<template>
    <div class="tiptap-wrapper">
        <div class="toolbar">
            <button @click="editor?.chain().focus().toggleBold().run()" :class="{ active: editor?.isActive('bold') }">B</button>
            <button @click="editor?.chain().focus().toggleItalic().run()" :class="{ active: editor?.isActive('italic') }">I</button>
            <button @click="editor?.chain().focus().toggleUnderline().run()" :class="{ active: editor?.isActive('underline') }">U</button>
            <button @click="editor?.chain().focus().toggleStrike().run()">S</button>
            <button @click="editor?.chain().focus().toggleHighlight().run()">HL</button>
            <button @click="editor?.chain().focus().setTextAlign('left').run()">L</button>
            <button @click="editor?.chain().focus().setTextAlign('center').run()">C</button>
            <button @click="editor?.chain().focus().setTextAlign('right').run()">R</button>
            <button @click="editor?.chain().focus().toggleBulletList().run()">UL</button>
            <button @click="editor?.chain().focus().toggleOrderedList().run()">OL</button>
            <button @click="editor?.chain().focus().insertTable({ rows: 3, cols: 3 }).run()">Table</button>
        </div>

        <EditorContent :editor="editor" class="editor" />
    </div>
</template>

<style scoped>
.tiptap-wrapper {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #ffffff;
    overflow: hidden;
}

.toolbar {
    display: flex;
    gap: 6px;
    padding: 8px;
    border-bottom: 1px solid #e5e7eb;
    background: #f9fafb;
}

.toolbar button {
    padding: 4px 8px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    background: #ffffff;
    font-size: 12px;
    cursor: pointer;
}

.toolbar button.active {
    background: #2563eb;
    color: #ffffff;
    border-color: #2563eb;
}

.editor {
    padding: 16px;
    min-height: 200px;
}

.editor :deep(p) {
    margin: 0 0 8px;
}
</style>
