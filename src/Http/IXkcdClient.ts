interface IXkcdClient {
    getComic(id: number): Promise<any>;
}

export default IXkcdClient;