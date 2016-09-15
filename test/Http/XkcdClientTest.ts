import kernel from "../../src/inversify.config";
import IHttpClient from "../../src/Http/IHttpClient";
import XkcdClient from "../../src/Http/XkcdClient";

describe('XKCD Client', () => {
    describe('getComic', () => {
        it('calls the correct URL on the HTTP client', done => {
            let httpClient = kernel.get<IHttpClient>("HttpClient");
            spyOn(httpClient, "get").and.returnValue(new Promise(resolve => resolve('{"id": 1}')));

            let xkcdClient = new XkcdClient(httpClient);

            xkcdClient.getComic(1).then(comic => {
                expect(httpClient.get).toHaveBeenCalledWith('http://xkcd.com/1/info.0.json');
                done();
            });
        });

        it('coverts the comic into JSON', done => {
            let httpClient = kernel.get<IHttpClient>("HttpClient");
            spyOn(httpClient, "get").and.returnValue(new Promise(resolve => resolve('{"id": 1}')));

            let xkcdClient = new XkcdClient(httpClient);

            xkcdClient.getComic(1).then(comic => {
                expect(comic).toEqual({id: 1});
                done();
            });
        });

        it ('throws Error on 404', done => {
            let httpClient = kernel.get<IHttpClient>("HttpClient");
            let xkcdClient = new XkcdClient(httpClient);

            xkcdClient.getComic(99999).catch(error => {
                expect(error).toEqual('HTTP request failed. Status code: 404. Error: null');
                done();
            });
        });
    });
});