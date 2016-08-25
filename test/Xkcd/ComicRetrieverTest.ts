import { expect } from "chai";
import kernel from "../../src/inversify.config";
import IComicRetriever from "../../src/Xkcd/IComicRetriever";

describe('Comic Retriever', () => {
    let comicRetriever:IComicRetriever = null;

    beforeEach(() => {
        comicRetriever = kernel.get<IComicRetriever>("ComicRetriever");
    });

    it('should return the HTML of the latest comic', (done) => {
        comicRetriever.getLatestComic().then((comicHtml) => {
            console.log(comicHtml);
            expect(comicHtml).to.be.a('string');
            done();
        });
    });
});