// Add below code to console, when telegram-web is open

(() => {
    const url = 'https://web.telegram.org/a/progressive/document5945217288742378260';

    const CONCURRENCY = 8;
    const CHUNK_SIZE = 524288; // 512 KB

    const btn = document.createElement('button');
    btn.textContent = '⚡ Fast Telegram Download';

    btn.style.cssText = `
        position:fixed;
        top:20px;
        right:20px;
        z-index:2147483647;
        padding:14px 20px;
        background:#168acd;
        color:white;
        border:0;
        border-radius:8px;
        font-size:14px;
        cursor:pointer;
    `;

    document.body.appendChild(btn);

    const sleep = ms => new Promise(r => setTimeout(r, ms));

    async function fetchChunk(start, total) {
        const end = Math.min(start + CHUNK_SIZE - 1, total - 1);

        for (let attempt = 1; attempt <= 8; attempt++) {
            try {
                const response = await fetch(url, {
                    method: 'GET',
                    credentials: 'include',
                    cache: 'no-store',
                    headers: {
                        Range: `bytes=${start}-${end}`
                    }
                });

                if (response.status !== 206 && !response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                const contentRange = response.headers.get('Content-Range');

                if (!contentRange) {
                    throw new Error('Content-Range missing');
                }

                const match = contentRange.match(
                    /bytes\s+(\d+)-(\d+)\/(\d+)/
                );

                if (!match) {
                    throw new Error(
                        `Invalid Content-Range: ${contentRange}`
                    );
                }

                const returnedStart = Number(match[1]);
                const returnedEnd = Number(match[2]);

                if (returnedStart !== start) {
                    throw new Error(
                        `Wanted ${start}, got ${returnedStart}`
                    );
                }

                const data = await response.arrayBuffer();

                return {
                    start: returnedStart,
                    end: returnedEnd,
                    data
                };

            } catch (e) {
                console.warn(
                    `Chunk ${start} failed. Attempt ${attempt}`,
                    e
                );

                if (attempt === 8) {
                    throw e;
                }

                await sleep(attempt * 500);
            }
        }
    }

    btn.onclick = async () => {
        btn.disabled = true;

        try {
            btn.textContent = 'Reading file info...';

            const firstResponse = await fetch(url, {
                credentials: 'include',
                cache: 'no-store',
                headers: {
                    Range: 'bytes=0-524287'
                }
            });

            const firstRange =
                firstResponse.headers.get('Content-Range');

            const firstMatch = firstRange?.match(
                /bytes\s+(\d+)-(\d+)\/(\d+)/
            );

            if (!firstMatch) {
                throw new Error(
                    `Cannot determine filesize: ${firstRange}`
                );
            }

            const total = Number(firstMatch[3]);

            console.log(
                'Total:',
                total,
                `${(total / 1024 / 1024).toFixed(2)} MB`
            );

            const handle = await window.showSaveFilePicker({
                suggestedName: 'telegram-video-5945217288742378260.mp4',

                types: [{
                    description: 'MP4 Video',
                    accept: {
                        'video/mp4': ['.mp4']
                    }
                }]
            });

            const writable = await handle.createWritable();

            const firstData = await firstResponse.arrayBuffer();

            await writable.write({
                type: 'write',
                position: 0,
                data: firstData
            });

            let downloaded = Number(firstMatch[2]) + 1;
            let nextOffset = downloaded;

            const startedAt = performance.now();

            while (nextOffset < total) {
                const jobs = [];

                for (
                    let i = 0; i < CONCURRENCY && nextOffset < total; i++
                ) {
                    const offset = nextOffset;

                    jobs.push(
                        fetchChunk(offset, total)
                    );

                    nextOffset += CHUNK_SIZE;
                }

                const chunks = await Promise.all(jobs);

                chunks.sort(
                    (a, b) => a.start - b.start
                );

                for (const chunk of chunks) {
                    await writable.write({
                        type: 'write',
                        position: chunk.start,
                        data: chunk.data
                    });

                    downloaded += chunk.data.byteLength;
                }

                const elapsed =
                    (performance.now() - startedAt) / 1000;

                const speed =
                    downloaded / 1024 / 1024 / elapsed;

                const percent =
                    Math.min(100, downloaded / total * 100);

                btn.textContent =
                    `${percent.toFixed(2)}% | ` +
                    `${speed.toFixed(2)} MB/s | ` +
                    `${(downloaded / 1024 / 1024).toFixed(0)} / ` +
                    `${(total / 1024 / 1024).toFixed(0)} MB`;

                console.log(
                    `${percent.toFixed(2)}%`,
                    `${speed.toFixed(2)} MB/s`
                );
            }

            await writable.close();

            btn.textContent = '✓ Download Complete';

            console.log(
                'Download complete:',
                total,
                'bytes'
            );

        } catch (e) {
            console.error(e);

            btn.textContent =
                '❌ Failed — see Console';

            btn.disabled = false;
        }
    };
})();
