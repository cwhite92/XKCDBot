import { expect } from "chai";
import kernel from "../../src/inversify.config";
import {TYPES, IComicRetriever} from "../../src/types";

describe('Comic Retriever', () => {
    let comicRetriever:any = null;

    beforeEach(() => {
        comicRetriever = kernel.get<IComicRetriever>(TYPES.ComicRetriever);
    });

    it('should return the HTML of the latest comic', (done) => {
        comicRetriever.getLatestComic().then((comicHtml) => {
            expect(comicHtml).to.be.a('string');
            done();
        });
    });
});