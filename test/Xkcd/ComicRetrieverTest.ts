import kernel from "../../src/inversify.config";
import IComicRetriever from "../../src/Xkcd/IComicRetriever";

describe('Comic Retriever', () => {
    let comicRetriever:IComicRetriever = null;

    beforeEach(() => {
        comicRetriever = kernel.get<IComicRetriever>("ComicRetriever");
    });
});