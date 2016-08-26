interface IRequestOptions {
    protocol?: string;
    host?: string;
    hostname?: string;
    family?: number;
    port?: number;
    localAddress?: string;
    socketPath?: string;
    method?: string;
    path?: string;
    headers?: { [key: string]: any };
    auth?: string;
}

export default IRequestOptions;