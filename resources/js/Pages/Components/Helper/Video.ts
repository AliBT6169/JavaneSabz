import { Node, mergeAttributes } from '@tiptap/core'

export interface VideoOptions {
    HTMLAttributes: Record<string, any>,
}

declare module '@tiptap/core' {
    interface Commands<ReturnType> {
        video: {
            /**
             * Add a video
             */
            setVideo: (options: { src: string }) => ReturnType,
        }
    }
}

export const Video = Node.create<VideoOptions>({
    name: 'video',
    group: 'block',
    atom: true,

    addOptions() {
        return {
            HTMLAttributes: {},
        }
    },

    addAttributes() {
        return {
            src: {
                default: null,
            },
            controls: {
                default: 'true',
            },
            style: {
                default: 'width: 100%; border-radius: 8px;'
            }
        }
    },

    parseHTML() {
        return [
            {
                tag: 'video',
            },
        ]
    },

    renderHTML({ HTMLAttributes }) {
        return ['video', mergeAttributes(this.options.HTMLAttributes, HTMLAttributes), ['source', { src: HTMLAttributes.src }]]
    },

    addCommands() {
        return {
            setVideo: options => ({ commands }) => {
                return commands.insertContent({
                    type: this.name,
                    attrs: options,
                })
            },
        }
    },
})
