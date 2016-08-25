interface IComicRetriever {
    getLatestComic(): Promise<string>;
}

export default IComicRetriever;